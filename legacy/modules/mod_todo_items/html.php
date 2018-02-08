<?php
/**
 * Todo - a Joomla example extension built with Nooku Framework.
 *
 * @package     Todo
 * @copyright   Copyright (C) 2011 - 2014 Timble CVBA. (http://www.timble.net)
 * @license     GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link        https://github.com/nooku/joomla-todo for the canonical source repository
 */

class ModTodo_itemsHtml extends ModKoowaHtml
{
    protected function _initialize(KObjectConfig $config)
    {
        $config->append(array(
            'auto_fetch'     => false,
            'model'          => 'com://admin/todo.model.items',
        ));

        parent::_initialize($config);
    }

    /**
     * Sets the model state using module parameters
     *
     * @param KModelInterface $model
     * @return $this
     */
    protected function _setModelState(KModelInterface $model)
    {
        $params = $this->module->params;

        // Set all parameters in the state to allow easy extension of the module
        $state = $params->toArray();

        if (substr($params->sort, 0, 8) === 'reverse_') {
            $state['sort'] = substr($params->sort, 8);
            $state['direction'] = 'desc';
        }

        $model->setState($state);

        if ($this->getObject('user')->authorise('core.manage', 'com_todo') !== true)
        {
            $model->enabled(1);
        }

        $model->limit($params->limit);

        return $this;
    }

    protected function _fetchData(KViewContext $context)
    {
        parent::_fetchData($context);

        $model = $this->getModel();

        $this->_setModelState($model);

        $context->data->items = $model->fetch();
        $context->data->total = $model->count();
    }

}