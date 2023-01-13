<?php

namespace App\Models\Discord;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class Webhook
{

    /*
     * Set webhook parameters
     */
    public function __construct()
    {
        $this->embeds = null;
        $this->content = null;
        $this->username = null;
        $this->avatar_url = null;
    }

    /*
     * Add an embed to this webhook
     *
     * @param json object Michel3951\Embed
     * @return Michel3951\DiscordWebhook\Webhook
     */
    public function setEmbed($embed)
    {
        $this->embeds = [$embed];
        return $this;
    }

    /*
     * Set the normal text content for this webhook
     *
     * @param string $value
     * @return Michel3951\DiscordWebhook\Webhook
     */
    public function setText($value)
    {
        if (strlen($value) > 2000) throw new \Exception('Webhook text cannot be longer then 2000 characters.');
        $this->content = $value;
        return $this;
    }

    /*
     * Set a custom username for this webhook
     *
     * @param string $name
     * @return Michel3951\DiscordWebhook\Webhook
     */
    public function setUsername($name)
    {
        if (strlen($name) > 32) throw new \Exception('Webhook username cannot be longer then 32 characters.');
        $this->username = $name;
        return $this;
    }

    /*
     * Set a custom avatar URL for this webhook
     *
     * @param string $url
     * @return Michel3951\DiscordWebhook\Webhook
     */
    public function setAvatar($url)
    {
        $this->avatar_url = $url;
        return $this;
    }

    /*
     * Send the webhook to Discord
     *
     * @param string $id
     * @param string $token
     * @exception GuzzleHttp\Exception\ClientException
     * @return \GuzzleHttp\Psr7\Response
     */
    public function send()
    {
        $client = new Client();
        $WEBHOOK_URL = env('DISCORD_WEBHOOK');

        if($WEBHOOK_URL == null) {
            return;
        }

        $result = $client->post($WEBHOOK_URL, [
            "headers" => [
                "Content-Type" => "application/json"
            ],
            "json" => [
                "content" => $this->content,
                "username" => $this->username,
                "avatar_url" => $this->avatar_url,
                "embeds" => $this->embeds
            ]
        ]);
        return $result;
    }
}
