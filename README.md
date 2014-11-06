PKP Notifications Dashboard API
===============================

Installation
------------

```
git clone https://github.com/MichaelThessel/pkpnapi.git [INSTALL_DIR]
cd [INSTALL_DIR]
cp config/autoload/local.php.dist config/autoload/local.php (set up!)
./composer.phar self-update
./composer.phar install
vendor/bin/doctrine-module orm:schema-tool:create
```


Example POST data
-----------------

```
$data = serialize(array('uuid' => '232c4384-6561-11e4-8e59-000c29ca125c', 'baseUrl' => 'http://example.com', 'journals' => array(
    array(
        'uuid' => '33d1b8b8-6561-11e4-90a5-000c29ca125c',
        'journalUrl' => 'http://example.com/journal',
    )
)));

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'http://example.com/api/getNotifications');
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, 'data=' . urlencode($data);
...

```
