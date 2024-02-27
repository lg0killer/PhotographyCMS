<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmailAudit extends Model
{
    protected $fillable = [
        'message_id',
        'from',
        'to',
        'bcc',
        'content',
        'subject',
        'status',
        'sent'
    ];

    protected $casts = [
        'from' => 'array',
        'to' => 'array',
        'bcc' => 'array'
    ];

    public static function parseEvent($event): array
    {
        $headers = $event->getHeaders();
        $dateString = $headers->get('references')->getValue();
        $dateString = str_replace(['<','>'],'', $dateString);
        $date = new \DateTime($dateString);
        $data = [
            'subject' => $headers->get('Subject')->getValue(),
            'email_at' => $date->format('<Y-m-d H:i:s>'),
            'to' => [],
            'from' => [],
            'bcc' => [],
            'content' => $event->getBody()->getBody()
        ];

        foreach ($headers->get('from')->getAddresses() as $email => $email_from) {
            $data['from'][] = [
                'name' => $email_from->getName(),
                'email' => $email_from->getAddress()
            ];
        }

        foreach ($headers->get('to')->getAddresses() as $email => $email_to) {
            $data['to'][] = [
                'name' => $email_to->getName(),
                'email' => $email_to->getAddress()
            ];
        }

        if ($headers->has('bcc')) {
            foreach ($headers->get('bcc')->getAddresses() as $email => $email_bcc) {
                $data['bcc'][] = [
                    'name' => $email_bcc->getName(),
                    'email' => $email_bcc->getAddress()
                ];
            }
        }

        $data['message_id'] = md5(serialize($data));

        return $data;
    }
}
