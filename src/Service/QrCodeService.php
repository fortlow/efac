<?php
declare(strict_types=1);

namespace App\Service;

use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\Builder\BuilderInterface;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Psr\Log\LoggerInterface;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\Logo\Logo;
use Endroid\QrCode\RoundBlockSizeMode;

class QrCodeService
{

    protected BuilderInterface $builder;
    private LoggerInterface $logger;

    public function __construct(BuilderInterface $builder, LoggerInterface $logger)
    {
        $this->builder = $builder;
        $this->logger = $logger;
    }

    public function qrcodeGenerate(string $target, string $slug): ?string
    {
        try {
            $query = '';
            $url = $_ENV['APP_DOMAIN'] . '/document/verify/'. $target .'/'.$slug;
            $this->logger->debug('qrcode generate url: '.$url);

            $path = dirname(__DIR__, 2) . '/public/img/';
            $this->logger->debug('qrcode generate path: '.$path);

            $writer = new PngWriter();

            $qrCode = new QrCode(
                data: $url,
                encoding: new Encoding('UTF-8'),
                errorCorrectionLevel: ErrorCorrectionLevel::Low,
                size: 135,
                margin: 2,
                roundBlockSizeMode: RoundBlockSizeMode::Margin,
                foregroundColor: new Color(255,255,255, 1),
                backgroundColor: new Color(26,41,72,0)
            );

            // Create generic logo
            $logo = new Logo(
                path: $path.'logo.jpg',
                resizeToWidth: 25,
                resizeToHeight: 20,
                punchoutBackground: true
            );

            $result = $writer->write($qrCode, $logo, null);

            //Save img png
            $pathFullQrCode = $path.'qr-code/'.$slug.'.png';
            $this->logger->debug('qrcode generate pathFullQrCode: '. $pathFullQrCode);

            $result->saveToFile($pathFullQrCode);

            return $result->getDataUri();

        } catch(\Exception $e) {
            $this->logger->error('qrcodeGenerate->exception: '.$e->getMessage());

            return null;
        }
    }

}