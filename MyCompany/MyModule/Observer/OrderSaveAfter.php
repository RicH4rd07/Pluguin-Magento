<?php
namespace MyCompany\MyModule\Observer;

use Magento\Framework\Event\ObserverInterface;

class OrderSaveAfter implements ObserverInterface {

    public function execute(\Magento\Framework\Event\Observer $observer) {
        $order = $observer->getEvent()->getOrder();
        
        $ch = curl_init();

          curl_setopt($ch, CURLOPT_URL, "https://deploy-dot-precise-line-76299minutos.appspot.com/api/v1/autorization/order");
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
          curl_setopt($ch, CURLOPT_HEADER, FALSE);

          curl_setopt($ch, CURLOPT_POST, TRUE);

          curl_setopt($ch, CURLOPT_POSTFIELDS, "{
            \"apikey\": \"{21a6763af91ab7f81bc4174913c645de0f2dd53d}\",
            \"deliveryType\": \"{sameDay}\",
            \"packageSize\": \"m\",
            \"notes\": \"{$order->getShippingMethod()}\",
            \"cahsOnDelivery\": true,
            \"amountCash\": 666,
            \"SecurePackage\": false,
            \"amountSecure\": 0,
            \"receivedId\": \"\",
            \"origin\": {
              \"sender\": \"{Juan Perez}\",
              \"nameSender\": \"{Juan}\",
              \"lastNameSender\": \"{Perez}\",
              \"emailSender\": \"{prueba2@prueba2.xom}\",
              \"phoneSender\": \"{5549483346}\",
              \"addressOrigin\": \"{Nopalera 313}\",
              \"numberOrigin\": \"{313}\",
              \"codePostalOrigin\": \"{57000}\",
              \"country\": \"MEX\"
            },
            \"destination\": {
              \"receiver\": \"{Pedro Paramo}\",
              \"nameReceiver\": \"{Pedro}\",
              \"lastNameReceiver\": \"{Paramo}\",
              \"emailReceiver\": \"{prueba1@prueba1.com}\",
              \"phoneReceiver\": \"{5548493643}\",
              \"addressDestination\": \"{comala 11}\",
              \"numberDestination\": \"238\",
              \"codePostalDestination\": \"{56500}\",
              \"country\": \"MEX\"
            }
          }");

          curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Content-Type: application/json"
          ));

          $response = curl_exec($ch);
          curl_close($ch);

    }
}