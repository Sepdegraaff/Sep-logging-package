<?php

declare(strict_types=1);

namespace Sep\LoggingPackage\Writers;

use Sep\LoggingPackage\Interfaces\WriterInterface;

class ApiWriter implements WriterInterface
{
    protected string $apiKey;
    protected string $apiUrl;
    protected string $channelId;

    public function __construct(string $apiKey, string $channelId, string $apiUrl)
    {
        $this->apiKey = $apiKey;
        $this->channelId = $channelId;
        $this->apiUrl = $apiUrl;
    }

    public function write(string $content): void
    {
        $data = [
            'channel' => $this->channelId,
            'text' => $content,
        ];

        try {
            $ch = curl_init($this->apiUrl);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Content-Type: application/x-www-form-urlencoded',
                'Authorization: Bearer ' . $this->apiKey,
            ]);

            $result = curl_exec($ch);

            if ($result === false) {
                throw new \RuntimeException('Error: ' . curl_error($ch));
            }

            $response = json_decode($result, true, 512, JSON_THROW_ON_ERROR);
            if (isset($response['ok']) && !$response['ok']) {
                throw new \RuntimeException('Slack API Error: ' . $response['error']);
            }
        } catch (\Throwable $exception) {
            echo "Error: " . $exception->getMessage();
        } finally {
            curl_close($ch);
        }
    }
}
