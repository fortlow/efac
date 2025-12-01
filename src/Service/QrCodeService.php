<?php
declare(strict_types=1);

namespace App\Service;

use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Label\Margin\Margin;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\Builder\BuilderInterface;

class QrCodeService
{
    /**
     * @var BuilderInterface
     */
    protected BuilderInterface $builder;

    public function __construct(BuilderInterface $builder)
    {
        $this->builder = $builder;
    }
    /**
     * @param string $target
     * @param string $slug
     * @return string|null
     */
    public function qrcodeGenerate(string $target, string $slug): ?string
    {
        try {
            $query = '';
            $url = $_ENV['APP_DOMAIN'] . '/document/verify/'. $target .'/'.$slug;
            //dump('qrcodeGenerate->url', $url);

            $path = dirname(__DIR__, 2) . '/public/img/';
            //dump('qrcodeGenerate->path', $path);

            // set qrcode
            $result = $this->builder
                ->data($url.$query)
                ->encoding(new Encoding('UTF-8'))
                //->errorCorrectionLevel(new ErrorCorrectionLevelHigh())
                ->size(135)
                ->margin(2)
                //->labelText($dateString)
                //->labelAlignment(new LabelAlignmentCenter())
                //->labelMargin(new Margin(15, 5, 5, 5))
                ->logoPath($path.'logo.jpg')
                ->logoResizeToWidth('25')
                ->logoResizeToHeight('20')
                ->foregroundColor(new Color(255,255,255, 1.00))
                ->backgroundColor(new Color(26,41,72,0.00))
                ->build()
            ;

            //Save img png
            $pathFullQrCode = $path.'qr-code/'.$slug.'.png';
            //dump('qrcodeGenerate->pathFullQrCode', $pathFullQrCode);
            $result->saveToFile($pathFullQrCode);

            return $result->getDataUri();
        } catch(\Exception $e) {
            //dump('qrcodeGenerate->exception', $e->getMessage());

            return null;
        }
    }
}