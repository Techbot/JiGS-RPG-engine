<?php
namespace emc23\helper;

/**
 * Class EnergyHelper
 */
abstract class EnergyHelper
{

        ///// TAKE ENERGY FROM USER'S BATTERIES UNTIL $energyUnitsRequired IS REACHED /////
    public function useBatteryNew($iduser, $energyUnitsRequired)
    {
        //$db = JFactory::getDBO();
        $user = JFactory::getUser();
        $message = "Energy Required : " . $energyUnitsRequired;
        MessagesHelper::sendFeedback($user->id, $message);

        $batteries = $this->get_all_energy($iduser);
        $total = $this->getTotalEnergy($iduser);
        $message = "Total Energy available : " . $total;
        MessagesHelper::sendFeedback($user->id, $message);

        if ($total < $energyUnitsRequired) {
            $message = "not enough energy";
            MessagesHelper::sendFeedback($user->id, $message);
            return false;
        }
        $this->updateBatteries($iduser, $energyUnitsRequired, $batteries, $user, $message);
        return true;
    }

    /**
     * @param $idUser
     * @return int
     */
    public function getTotalEnergy($idUser)
    {
        $batteries = $this->getAllEnergy($idUser);
        $total = 0;
        foreach ($batteries as $battery) {
            $total = $total + $battery->units;
        }
        return $total;
    }

    ///// GET ALL BATTERIES FOR ONE USER /////
    /**
     * @param $UserId
     * @return mixed
     */
    public function getAllEnergy($UserId)
    {
        // $db		= JFactory::getDBO();
        //$sql		= "SELECT * FROM #__jigs_batteries WHERE user = " . $id;
        //$db->setQuery($sql);
        //$_all_energy	= $db->loadObjectList();
        return $_all_energy;
    }

    /**
     * @param $batteryId
     * @param $energyUnitsRequired
     * @param $batteries
     * @param $user
     * @param $message
     * @return bool
     */
    public function updateBatteries($batteryId, $energyUnitsRequired,
        $batteries, $user, $message
    ) {
        $this->unitsDeductedLoop($energyUnitsRequired, $batteries, $user, $message);

        $total = $this->getTotalEnergy($batteryId);
        $message = $total . " remaining energy units";
        MessagesHelper::sendFeedback($user->id, $message);
        return true;
    }

    /**
     * @param $energyUnitsRequired
     * @param $batteries
     * @param $user
     * @param $message
     * @return string
     */
    protected function unitsDeductedLoop($energyUnitsRequired,
        $batteries, $user, $message
    ) {
        $iter = 1;
        foreach ($batteries as $battery) {
            if ($energyUnitsRequired > 0) {
                if ($energyUnitsRequired < $battery->units) {
                    $db = JFactory::getDBO();
                    $battery->units = $battery->units - $energyUnitsRequired;
                    $message = $energyUnitsRequired . " unit(s) deducted from  battery " . $iter;
                    $energyUnitsRequired = 0;
                    MessagesHelper::sendFeedback($user->id, $message);
                } else {
                    $energyUnitsRequired = $energyUnitsRequired - $battery->units;
                    $message .= $battery->units . " unit(s) deducted from  battery " . $iter . "<br/>";
                    $battery->units = 0;
                    $message .= "zero units remaining in battery " . $iter . "</br>";
                    MessagesHelper::sendFeedback($user->id, $message);
                }

                $sql = "UPDATE #__jigs_batteries SET units = " . $battery->units . "
                WHERE id = " . $battery->id;
                $db->setQuery($sql);
                $db->query();
            } else {
                $message = "energy transer complete";
                MessagesHelper::sendFeedback($user->id, $message);
                break;
            }
            $iter++;
        }
        return;
    }
}
