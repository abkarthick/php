<?php
// UFW Firewall Rules php
if (isset($_POST['submit'])) {
    $ip = $_POST['ip'];
    $protocol = $_POST['protocol'];
    $port = $_POST['port'];
    $action = $_POST['action'];

    //Check if ufw is installed
    $check_ufw = shell_exec("which ufw");
    if (empty($check_ufw)) {
        echo "ufw is not installed on this server. Please install it and try again.";
        exit();
    }

    //Add or remove the firewall rule based on the action selected
    if ($action == "allow") {
        exec("ufw allow from $ip to any port $port proto $protocol");
        echo "Firewall rule added successfully for IP: $ip, Protocol: $protocol and Port: $port.";
    } else {
        exec("ufw deny from $ip to any port $port proto $protocol");
        echo "Firewall rule added successfully for IP: $ip, Protocol: $protocol and Port: $port.";
    }
}
?>

<form method="post">
    <label for="ip">IP Address:</label>
    <input type="text" id="ip" name="ip" required>
    <br>
    <label for="protocol">Protocol:</label>
    <select id="protocol" name="protocol" required>
        <option value="tcp">TCP</option>
        <option value="udp">UDP</option>
    </select>
    <br>
    <label for="port">Port:</label>
    <input type="number" id="port" name="port" min="1" max="65535" required>
    <br>
    <label for="action">Action:</label>
    <select id="action" name="action" required>
        <option value="allow">Allow</option>
        <option value="deny">Deny</option>
    </select>
    <br>
    <input type="submit" name="submit" value="Add Firewall Rule">
</form>
