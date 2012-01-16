<?php

namespace Shop\MainBundle\Model;

use Xi\Decimal\Decimal;

class Money extends Decimal
{
    const SCALE = 50; // TODO: Figure out min/max scale.
    
    /**
     * @param float|string|int $amount
     * @param int              $scale
     */
    public function __construct($amount, $scale = self::SCALE)
    {
        $this->amt   = $this->asNormalizedString($amount, (int) $scale);
        $this->scale = (int) $scale;
    }
    
    /**
     * @param  float|string|int $amount
     * @param  int              $scale
     * @return Money
     */
    public static function create($amount, $scale = self::SCALE)
    {
        return new static($amount, $scale);
    }
    
    /**
     * @return Money
     */
    public function round()
    {
        return new static(round($this->getAmt(), 2));
    }
    
    /**
     * Rounds before returning amount as string.
     * Limits decimals to 2.
     * 
     * @return string
     */
    public function __toString()
    {
        return static::create($this->round()->getAmt())->getAmt();
    }
    
    /**
     * @return string
     */
    public function toString()
    {
        return $this->__toString();
    }
}