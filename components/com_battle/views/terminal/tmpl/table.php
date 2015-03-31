<table width ='100%'>
    <tr>
        <td>id:</td><td>$id</td>
        <td>Level:</td><td>$level</td>
        <td>ip:</td><td>$ip</td>
    </tr>
    <tr>
        <td>bandwidth:</td><td>$bandwidth</td>
        <td>capacity:</td><td>$capacity</td>
        <td>version:</td><td>$version</td>
    </tr>
    <tr>
        <td>status:</td><td>$status</td>
        <td>faction:</td><td>$faction</td>
        <td>battery</td><td>$battery</td>
    </tr>
</table>
<div id='action' class='clearfix'>
    <!-- <div class='recruit'><a class='recruit' href='#'>Recruit</a></div> -->
    <div class='shoot'><a onclick='enter("scan")' id='type_scan' >Scan</a></div>
    <div class='kick'><a onclick='enter("Decrypt")' id='kick' >Decrypt</a> </div>
    <div class='punch'><a onclick='enter("punch")' id='punch'>Hack</a> </div>
    <div class='shoot'><a onclick='enter("SSH Login")' id='shoot' >SSH Login</a></div>
    <div class='kick'><a onclick='enter("SSH Logout")' id='kick' >SSH Logout</a> </div>
    <div class='punch'><a onclick='enter("Download")' id='punch'>Download</a> </div>
    <div class='punch'><a onclick='enter("Upload")' id='punch'>Upload</a> </div>
    <div class='punch'><a onclick='enter("Delete")' id='punch'>Delete</a> </div>
    <div class='punch'><a onclick='enter("Trace")' id='punch'>Trace</a> </div>
    <div class='punch'><a onclick='enter("Killtrace")' id='punch'>Killtrace</a> </div>
    <div class='punch'><a onclick='enter("Deploy Virus")' id='punch'>Deploy Virus</a> </div>
    <div class='punch'><a onclick='enter("Execute")' id='punch'>Execute</a> </div>
    <div class='punch'><a onclick='enter("Entert")'>Enter</a> </div>
    <input type='text' onchange='type_scan' name='commandLine'
           class='form-control input-lg' id='commandLine' placeholder='Enter Command'>
    <!--   <div class='bribe'><a class='bribe' href='#'>Bribe</a></div>
    <div class='rob'><a class='rob' href=#'>Rob</a></div>
    <div class='talk'<a class='talk' href=''#'>Talk</a></div>-->
</div><!-- end action --><!--

