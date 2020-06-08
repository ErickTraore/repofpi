<?php
namespace App\Service;

use App\Controller\EnvoiesmsController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class Smslws extends Controller
{
    /**
    * @Route("/smslws")
    */
    public function envoilws($number_phone,$message_phone)
    {
        $num=$number_phone;
        $gateway_url = "https://sms.lws.fr/sms/api";
        $action = "send-sms";
        $apiKey  = "ZGFvdWRhOiQyeSQxMCRneVdNTWhZT3dpYTdhb0NNLlI2blAuSkRMY2ZNSmRsbGZ4OS5yUHdGU1NOaC52Mk9OcURhUw==";
        $to = $num;
        $senderID  = "FPI_GBAGBO";
        $message  = urlencode($message_phone);
        // Prepare le tableau de données pour la requête API
        $data = array('action' => $action,
                  'api_key' => $apiKey,
                  'to' => $to,
                  'from' => $senderID,
                  'sms' => $message,
            );
        // Envoie la requête API via cURL
        $ch = curl_init($gateway_url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        $get_data = json_decode($response, true);
        /* On traite le retour.
         * get_date['code'] récupére un code selon la réussite ou l'erreur de l'API
         * get_date['Message'] récupére le message Success ou explication de l'erreur.
         */
        if ($get_data['code'] === 'ok') {
            echo 'Le SMS a bien été envoyé';
        } else {
            echo 'Code test Erreur : '.$get_data['code'].' -- '.$get_data['message'];
        }
    }
}