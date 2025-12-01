<?php
declare(strict_types=1);

namespace App\Twig;

use App\Service\QrCodeService;
use App\Service\UtilityService;
use Doctrine\ORM\EntityManagerInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class AppExtension extends AbstractExtension
{
    private EntityManagerInterface $_em;
    public function __construct(EntityManagerInterface $em)
    {
        $this->_em = $em;
    }

    /**
     * @return array
     */
    public function getFilters(): array
    {
        return [
            new TwigFilter('mask', [$this, 'generateMask']),
            new TwigFilter('xof', [$this, 'formatXof']),
            new TwigFilter('xaf', [$this, 'formatXaf']),
            new TwigFilter('cut', [$this, 'formatCut']),
            new TwigFilter('random', [$this, 'generateRandomNumber']),
            new TwigFilter('labrole', [$this, 'labelRole']),
            new TwigFilter('convertinttoLetter', [$this, 'convertIntToLetter']),
        ];
    }
    /**
     * @return array
     */
    public function getFunctions(): array
    {
        return [
            new TwigFunction('subdate', [$this, 'subDate']),
            new TwigFunction('cuttext', [$this, 'cutText']),
            new TwigFunction('difdate', [$this, 'difDate']),
            new TwigFunction('difdatemonth', [$this, 'difDateDayForMonth']),
            new TwigFunction('difdateyear', [$this, 'difDateDayForYear']),
            new TwigFunction('inwishlist', [$this, 'inWishlist']),
            new TwigFunction('addyeartodate', [$this, 'addYearToDate']),
            new TwigFunction('addmonthtodate', [$this, 'addMonthToDate']),
            new TwigFunction('comparedate', [$this, 'compareDate']),
            new TwigFunction('mapperletter', [$this, 'mapperLetter']),
            new TwigFunction('verififphotoexist', [$this, 'verifIfPhotoExist']),
        ];
    }

    // FILTERS

    /**
     * @param $expression
     *
     * @return string
     */
    public function generateMask($expression): string
    {
        return str_repeat('*', strlen($expression));
    }
    /**
     * @param $number
     * @param int $decimals
     * @param string $decimalSep
     * @param string $thousandsSep
     *
     * @return string
     */
    public function formatXof($number, int $decimals = 0, string $decimalSep = '.', string $thousandsSep = ','): string
    {
        $price = number_format($number, $decimals, $decimalSep, $thousandsSep);
        $price = $price . ' XOF';

        if (!is_null($decimalSep)) {
            if($decimalSep == '.') { $price = 'XAF ' . $price; } else { $price = $price . ' XAF'; }
        } else {
            $price = $price . ' XAF';
        }

        return $price;
    }
    /**
     * @param $number
     * @param int $decimals
     * @param string $decimalSep
     * @param string $thousandsSep
     *
     * @return string
     */
    public function formatXaf($number, int $decimals = 0, string $decimalSep = '.', string $thousandsSep = ','): string
    {
        $price = number_format($number, $decimals, $decimalSep, $thousandsSep);

        if (!is_null($decimalSep)) {
            if($decimalSep == '.') { $price = 'XOF ' . $price; } else { $price = $price . ' XOF'; }
        } else {
            $price = $price . ' XOF';
        }

        return $price;
    }
    /**
     * @param $txt
     * @return string
     */
    public function formatCut($txt): string
    {
        return substr($txt, 0, 1);
    }
    /**
     * @param $min
     * @param $max
     *
     * @return int
     */
    public function generateRandomNumber($min, $max): int
    {
        return rand($min, $max);
    }
    /**
     * @param string $code
     * @return string
     */
    public function labelRole(string $code): string
    {
        return match ($code) {
            'ROLE_ADMIN' => 'Administrateur',
            'ROLE_MANAGER' => 'Gestionnaire',
            'ROLE_SALE' => 'Commercial(e)',
            'ROLE_CLIENT' => 'Client',
            'ROLE_COMPTABLE' => 'Comptable',
            default => '',
        };
    }
    /**
     * @param string $montant
     * @return string
     */
    public function convertIntToLetter(string $montant): string
    {
        try {
            setlocale(LC_ALL, 'fr_FR.UTF-8', 'fr_FR', 'fra', 'french');

            $formatter = \NumberFormatter::create('fr_FR', \NumberFormatter::SPELLOUT);
            $formatter->setAttribute(\NumberFormatter::FRACTION_DIGITS, 0);
            $formatter->setAttribute(\NumberFormatter::ROUNDING_MODE, \NumberFormatter::ROUND_HALFUP);

            return $formatter->format(intval($montant));
        } catch (\Exception $e) {
            //dump($e->getMessage());

            return $montant;
        }
    }

    // FUNCTIONS

    /**
     * @param string $date
     * @param int $nbday
     * @return \DateTime
     * @throws \Exception
     */
    public function subDate(string $date, int $nbday): \DateTime
    {
        $newDate = new \DateTime($date);
        $interval = new \DateInterval('P' . $nbday . 'D');
        return $newDate->sub($interval);
    }
    /**
     * @param \DateTime $date1
     * @param \DateTime $date2
     *
     * @return int
     */
    public function difDate(\DateTime $date1, \DateTime $date2): int
    {
        $nbDay = $date1->diff($date2);
        return $nbDay->days;
    }
    /**
     * Retourne le nombre de mois entre la date du jour et la date x passe en parametre
     * @param \DateTime $date
     * @return int
     */
    public function difDateDayForYear(\DateTime $date): int
    {
        $dateDay = new \DateTime('now');
        return $date->diff($dateDay)->m;
    }
    /**
     * Retourne le nombre de jours entre la date du jour et la date x passe en parametre
     * @param \DateTime $date
     * @return int
     */
    public function difDateDayForMonth(\DateTime $date): int
    {
        $dateDay = new \DateTime('now');
        $nbDay = $dateDay->diff($date);

        return $nbDay->days;
    }
    /**
     * @param \DateTime $date
     * @param $nbYear
     *
     * @return \DateTime
     * @throws \Exception
     */
    public function addYearToDate(\DateTime $date, $nbYear): \DateTime
    {
        $interval = new \DateInterval('P' . $nbYear . 'Y');
        return $date->add($interval);
    }
    /**
     * @param \DateTime $date
     * @param           $nbMonth
     * @return \DateTime
     * @throws \Exception
     */
    public function addMonthToDate(\DateTime $date, $nbMonth): \DateTime
    {
        $interval = new \DateInterval('P' . $nbMonth . 'M');
        return $date->add($interval);
    }
    /**
     * @param $txt
     * @param int $limit
     *
     * @return string
     */
    public function cutText($txt, int $limit = 20): string
    {
        return $this->text($txt, $limit);
    }
    /**
     * @param string $string
     * @param int $limit
     *
     * @return string
     */
    public function text( string $string, int $limit = 20): string
    {
        $text = explode(" ", $string);
        $nb = 0;
        $new = "";
        foreach ($text as $word) {
            if ($nb <= $limit) {
                $new .= $word;
                $new .= " ";
            }
            $nb++;
        }

        return ($new);
    }
    /**
     * @param array $wishlist
     * @param int $idprd
     *
     * @return bool
     */
    public function inWishlist(array $wishlist, int $idprd): bool
    {
        $flag = false;

        if (!empty($wishlist)) {
            if (in_array($idprd, $wishlist)) {
                $flag = true;
            }
        }

        return $flag;
    }
    /**
     * @param \DateTime $d1
     * @param \DateTime $d2
     * @return int
     */
    public function compareDate(\DateTime $d1, \DateTime $d2): int
    {
        $transD1 = $d1->format('Y-m-d H:i');
        $transD2 = $d2->format('Y-m-d H:i');

        if ($transD1 > $transD2) {
            return 1;
        } elseif ($transD1 === $transD2) {
            return 0;
        } else {
            return -1;
        }
    }
    /**
     * @param string $digit
     * @return string
     */
    public function mapperLetter(string $digit): string
    {
        return match (intval($digit)) {
            1 => 'one',
            2 => 'two',
            3 => 'three',
            4 => 'four',
            default => '',
        };
    }
    /**
     * @param string $filename
     * @return bool
     */
    public function verifIfPhotoExist(string $filename): bool
    {
        $fileFullName = $_ENV['DIR_PHOTO'] .'/'. $filename;
        if(file_exists($fileFullName)) return true;

        return false;
    }
}