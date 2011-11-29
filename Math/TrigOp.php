<?php
//
// +----------------------------------------------------------------------+
// | PHP Version 5                                                        |
// +----------------------------------------------------------------------+
// | Copyright (c) 1997-2003 The PHP Group                                |
// +----------------------------------------------------------------------+
// | This source file is subject to version 3.0 of the PHP license,       |
// | that is bundled with this package in the file LICENSE, and is        |
// | available at through the world-wide-web at                           |
// | http://www.php.net/license/3_0.txt.                                 |
// | If you did not receive a copy of the PHP license and are unable to   |
// | obtain it through the world-wide-web, please send a note to          |
// | license@php.net so we can mail you a copy immediately.               |
// +----------------------------------------------------------------------+
// | Authors: Jesus M. Castagnetto <jmcastagnetto@php.net>                |
// +----------------------------------------------------------------------+
//
// $Id$
//

require_once 'PEAR.php';

/**
 * MATH_TRIGOP_EPSILON
 */
if (!defined('MATH_TRIGOP_EPSILON')) {
    define('MATH_TRIGOP_EPSILON', 1E-15);
}

/**
 * Static class implementing circular and hyperbolic trigonometric functions, and their inverses
 *
 * Example of use:
 *
 * require_once 'Math/TrigOp.php';
 * $cot = Math_TrigOp::cot(0.3445);
 * $x = Math_TrigOp::acsch(-0.231);
 * 
 * Originally this class was part of NumPHP (Numeric PHP package)
 *
 * @author	Jesus M. Castagnetto <jmcastagnetto@php.net>
 * @version	2.0
 * @access	public
 * @package	Math_TrigOp
 */
class Math_TrigOp {/*{{{*/

    // Trigonometric functions

    /**
     * Calculates the sine of the paramater
     *
     * @param float $x
     * @return PEAR_Error|float A floating point on success, PEAR_Error object otherwise
     * @public static
     * @access public
     */
    public static function sin($x) /*{{{*/
    {
        if (!is_numeric($x)) {
            return PEAR::raiseError('Expecting a numeric parameter');
        }
        return Math_TrigOp::zeroIfVerySmall(sin(floatval($x)));
    } /*}}}*/

    /**
     * Calculates the cosine of the paramater
     *
     * @param float $x
     * @return PEAR_Error|float A floating point on success, PEAR_Error object otherwise
     * @public static
     * @access public
     */
    public static function cos($x) /*{{{*/
    {
        if (!is_numeric($x)) {
            return PEAR::raiseError('Expecting a numeric parameter');
        }
        return Math_TrigOp::zeroIfVerySmall(cos(floatval($x)));
    } /*}}}*/

    /**
     * Calculates the tangent of the paramater
     *
     * @param float $x
     * @return PEAR_Error|float A floating point on success, PEAR_Error object otherwise
     * @public static
     * @access public
     */
    public static function tan($x) /*{{{*/
    {
        if (!is_numeric($x)) {
            return PEAR::raiseError('Expecting a numeric parameter');
        }
        $c = cos(floatval($x));
        if (Math_TrigOp::isCloseToZero($c)) {
            return PEAR::raiseError('Tangent undefined for '.$x.', cosine is too close to zero');
        } else {
            return Math_TrigOp::zeroIfVerySmall(tan(floatval($x)));
        }
    } /*}}}*/
    
	/**
	 * Calculates the secant of the parameter
	 * 
	 * @param float $x
     * @return PEAR_Error|float A floating point on success, PEAR_Error object otherwise
     * @public static
	 * @access public
	 */
	public static function sec($x) /*{{{*/
    {
        if (!is_numeric($x)) {
            return PEAR::raiseError('Expecting a numeric parameter');
        }
		$x = floatval($x);
		$c = cos($x);
        if (Math_TrigOp::isCloseToZero($c)) {
			return PEAR::raiseError('Undefined operation, cosine of parameter is zero');
		} else {
            return Math_TrigOp::zeroIfVerySmall(1/$c);
		}
	}/*}}}*/

	/**
	 * Calculates the cosecant of the parameter
	 * 
	 * @param float $x
     * @return PEAR_Error|float A floating point on success, PEAR_Error object otherwise
     * @public static
	 * @access public
	 */
	public static function csc($x) /*{{{*/
    {
        if (!is_numeric($x)) {
            return PEAR::raiseError('Expecting a numeric parameter');
        }
		$x = floatval($x);
		$s = sin($x);
        if (Math_TrigOp::isCloseToZero($s)) {
			return PEAR::raiseError('Undefined operation, sine of parameter is zero');
		} else {
            return Math_TrigOp::zeroIfVerySmall(1/$s);
		}
	}/*}}}*/

	/**
	 * Calculates the cotangent of the parameter
	 * 
	 * @param float $x
     * @return PEAR_Error|float A floating point on success, PEAR_Error object otherwise
     * @public static
	 * @access public
	 */
	public static function cot($x) {/*{{{*/
        if (!is_numeric($x)) {
            return PEAR::raiseError('Expecting a numeric parameter');
        }
		$x = floatval($x);
		$t = tan($x);
        if (Math_TrigOp::isCloseToZero($t)) {
			return PEAR::raiseError('Undefined operation, tangent of parameter is zero');
		} else {
            return Math_TrigOp::zeroIfVerySmall(1/$t);
		}
	}/*}}}*/

    // inverse trigonometric functions

    /**
     * Calculates the inverse sine of the paramater
     *
     * @param float $x
     * @return PEAR_Error|float A floating point on success, PEAR_Error object otherwise
     * @public static
     * @access public
     */
    public static function asin($x) /*{{{*/
    {
        if (!is_numeric($x)) {
            return PEAR::raiseError('Expecting a numeric parameter');
        }
        return Math_TrigOp::zeroIfVerySmall(asin(floatval($x)));
    } /*}}}*/

    /**
     * Calculates the inverse cosine of the paramater
     *
     * @param float $x
     * @return PEAR_Error|float A floating point on success, PEAR_Error object otherwise
     * @public static
     * @access public
     */
    public static function acos($x) /*{{{*/
    {
        if (!is_numeric($x)) {
            return PEAR::raiseError('Expecting a numeric parameter');
        }
        return Math_TrigOp::zeroIfVerySmall(acos(floatval($x)));
    } /*}}}*/

    /**
     * Calculates the inverse tangent of the paramater
     *
     * @param float $x
     * @return PEAR_Error|float A floating point on success, PEAR_Error object otherwise
     * @public static
     * @access public
     */
    public static function atan($x) /*{{{*/
    {
        if (!is_numeric($x)) {
            return PEAR::raiseError('Expecting a numeric parameter');
        }
        return Math_TrigOp::zeroIfVerySmall(atan(floatval($x)));
    } /*}}}*/

    /**
     * Calculates the inverse tangent of the paramater
     *
     * @param float $x
     * @param float $y
     * @return PEAR_Error|float A floating point on success, PEAR_Error object otherwise
     * @public static
     * @access public
     */
    public static function atan2($x, $y) /*{{{*/
    {
        if (!is_numeric($x)) {
            return PEAR::raiseError('Expecting a numeric parameter');
        }
        return Math_TrigOp::zeroIfVerySmall(atan2(floatval($x), floatval($y)));
    } /*}}}*/

    /**
     * Calculates the inverse secant of the paramater
     *
     * @param float $x
     * @return PEAR_Error|float A floating point on success, PEAR_Error object otherwise
     * @public static
     * @access public
     */
    public static function asec($x)/*{{{*/
    {
        if (!is_numeric($x)) {
            return PEAR::raiseError('Expecting a numeric parameter');
        }
        if (Math_TrigOp::isCloseToZero($x)) {
            return PEAR::raiseError('Value to close to zero: '.$x);
        }
        $cos = 1/$x;
        return Math_TrigOp::zeroIfVerySmall(acos($cos));
    }/*}}}*/
    
    /**
     * Calculates the inverse cosecant of the paramater
     *
     * @param float $x
     * @return PEAR_Error|float A floating point on success, PEAR_Error object otherwise
     * @public static
     * @access public
     */
    public static function acsc($x)/*{{{*/
    {
        if (!is_numeric($x)) {
            return PEAR::raiseError('Expecting a numeric parameter');
        }
        if (Math_TrigOp::isCloseToZero($x)) {
            return PEAR::raiseError('Value to close to zero: '.$x);
        }
        $sin = 1/$x;
        return Math_TrigOp::zeroIfVerySmall(asin($sin));
    }/*}}}*/
    
    /**
     * Calculates the inverse cotangent of the paramater
     *
     * @param float $x
     * @return PEAR_Error|float A floating point on success, PEAR_Error object otherwise
     * @public static
     * @access public
     */
    public static function acot($x)/*{{{*/
    {
        if (!is_numeric($x)) {
            return PEAR::raiseError('Expecting a numeric parameter');
        }
        if (Math_TrigOp::isCloseToZero($x)) {
            return PEAR::raiseError('Value to close to zero: '.$x);
        }
        $tan = 1/$x;
        return Math_TrigOp::zeroIfVerySmall(atan($tan));
    }/*}}}*/
    
	// Hyperbolic functions

    /**
     * Calculates the hyperbolic sine of the paramater
     *
     * @param float $x
     * @return PEAR_Error|float A floating point on success, PEAR_Error object otherwise
     * @public static
     * @access public
     */
    public static function sinh($x) /*{{{*/
    {
        if (!is_numeric($x)) {
            return PEAR::raiseError('Expecting a numeric parameter');
        }
        return Math_TrigOp::zeroIfVerySmall(sinh(floatval($x)));
    } /*}}}*/

    /**
     * Calculates the hyperbolic cosine of the paramater
     *
     * @param float $x
     * @return PEAR_Error|float A floating point on success, PEAR_Error object otherwise
     * @public static
     * @access public
     */
    public static function cosh($x) /*{{{*/
    {
        if (!is_numeric($x)) {
            return PEAR::raiseError('Expecting a numeric parameter');
        }
        return Math_TrigOp::zeroIfVerySmall(cosh(floatval($x)));
    } /*}}}*/

    /**
     * Calculates the hyperbolic tangent of the paramater
     *
     * @param float $x
     * @return PEAR_Error|float A floating point on success, PEAR_Error object otherwise
     * @public static
     * @access public
     */
    public static function tanh($x) /*{{{*/
    {
        if (!is_numeric($x)) {
            return PEAR::raiseError('Expecting a numeric parameter');
        }
        return Math_TrigOp::zeroIfVerySmall(tanh(floatval($x)));
    } /*}}}*/
	/**
	 * Calculates the hyperbolic secant of the parameter
	 * 
	 * @param float $x
     * @return PEAR_Error|float A floating point on success, PEAR_Error object otherwise
     * @public static
	 * @access public
	 */
	public static function sech ($x) {/*{{{*/
        if (!is_numeric($x)) {
            return PEAR::raiseError('Expecting a numeric parameter');
        }
		$c = cosh(floatval($x));
        if (Math_TrigOp::isCloseToZero($c)) {
			return PEAR::raiseError('Undefined operation, hyperbolic cosine of parameter is zero');
		} else {
            return Math_TrigOp::zeroIfVerySmall(1/$c);
		}
	}/*}}}*/

	/**
	 * Calculates the hyperbolic cosecant of the parameter
	 * 
	 * @param float $x
     * @return PEAR_Error|float A floating point on success, PEAR_Error object otherwise
     * @public static
	 * @access public
	 */
	public static function csch ($x) {/*{{{*/
        if (!is_numeric($x)) {
            return PEAR::raiseError('Expecting a numeric parameter');
        }
		$s = sinh(floatval($x));
        if (Math_TrigOp::isCloseToZero($s)) {
			return PEAR::raiseError('Undefined operation, hyperbolic sine of parameter is zero');
		} else {
            return Math_TrigOp::zeroIfVerySmall(1/$s);
		}
	}/*}}}*/

	/**
	 * Calculates the hyperbolic cotangent of the parameter
	 * 
	 * @param float $x
     * @return PEAR_Error|float A floating point on success, PEAR_Error object otherwise
     * @public static
	 * @access public
	 */
	public static function coth ($x) {/*{{{*/
        if (!is_numeric($x)) {
            return PEAR::raiseError('Expecting a numeric parameter');
        }
		$t = tanh(floatval($x));
        if (Math_TrigOp::isCloseToZero($t)) {
			return PEAR::raiseError('Undefined operation, hyperbolic tangent of parameter is zero');
		} else {
            return Math_TrigOp::zeroIfVerySmall(1/$t);
		}
	}/*}}}*/

	// Inverse hyperbolic functions

    /**
     * Calculates the inverse hyperbolic sine of the paramater
     *
     * @param float $x
     * @return PEAR_Error|float A floating point on success, PEAR_Error object otherwise
     * @public static
     * @access public
     */
    public static function asinh($x) /*{{{*/
    {
        if (!is_numeric($x)) {
            return PEAR::raiseError('Expecting a numeric parameter');
        }
        return Math_TrigOp::zeroIfVerySmall(asinh(floatval($x)));
    } /*}}}*/

    /**
     * Calculates the inverse hyperbolic cosine of the paramater
     *
     * @param float $x
     * @return PEAR_Error|float A floating point on success, PEAR_Error object otherwise
     * @public static
     * @access public
     */
    public static function acosh($x) /*{{{*/
    {
        if (!is_numeric($x)) {
            return PEAR::raiseError('Expecting a numeric parameter');
        }
        return Math_TrigOp::zeroIfVerySmall(acosh(floatval($x)));
    } /*}}}*/

    /**
     * Calculates the inverse hyperbolic tangent of the paramater
     *
     * @param float $x
     * @return PEAR_Error|float A floating point on success, PEAR_Error object otherwise
     * @public static
     * @access public
     */
    public static function atanh($x) /*{{{*/
    {
        if (!is_numeric($x)) {
            return PEAR::raiseError('Expecting a numeric parameter');
        }
        return Math_TrigOp::zeroIfVerySmall(atanh(floatval($x)));
    } /*}}}*/

	/**
	 * Calculates the inverse hyperbolic secant of the parameter
	 * 
	 * @param float $x
     * @return PEAR_Error|float A floating point on success, PEAR_Error object otherwise
     * @public static
	 * @access public
	 */
	public static function asech ($x) /*{{{*/
    {
        if (!is_numeric($x)) {
            return PEAR::raiseError('Expecting a numeric parameter');
        }
        $x = floatval($x);
        if (Math_TrigOp::isCloseToZero($x)) {
			return PEAR::raiseError('Undefined operation, parameter is too close zero or zero');
		} else {
            $r = log((1 + sqrt(1 - $x*$x)) / $x);
            return Math_TrigOp::zeroIfVerySmall($r);
		}
	}/*}}}*/

	/**
	 * Calculates the inverse hyperbolic cosecant of the parameter
	 * 
	 * @param float $x
     * @return PEAR_Error|float A floating point on success, PEAR_Error object otherwise
     * @public static
	 * @access public
	 */
	public static function acsch ($x) /*{{{*/
    {
        if (!is_numeric($x)) {
            return PEAR::raiseError('Expecting a numeric parameter');
        }
        $x = floatval($x);
        if (Math_TrigOp::isCloseToZero($x)) {
			return PEAR::raiseError('Undefined operation, parameter is too close zero or zero');
		} elseif ($x < 0) {
			return PEAR::raiseError('Undefined operation, parameter is negative');
		} else {
            $r = log((1 + sqrt(1 + $x*$x)) / $x);
            return Math_TrigOp::zeroIfVerySmall($r);
		}
	}/*}}}*/

	/**
	 * Calculates the inverse hyperbolic cotangent of the parameter
	 * 
	 * @param float $x
     * @return PEAR_Error|float A floating point on success, PEAR_Error object otherwise
     * @public static
	 * @access public
	 */
	public static function acoth ($x) {/*{{{*/

        if (!is_numeric($x)) {
            return PEAR::raiseError('Expecting a numeric parameter');
        }
        $x = floatval($x);
		if ($x == 1.0) {
			return PEAR::raiseError('Undefined operation, parameter is 1.0');
		} else {
			$rat = ($x + 1)/($x - 1);
			if ($rat < 0) {
				return PEAR::raiseError('Undefined operation, (x+1)/(x-1) is negative');
			} else {
                return Math_TrigOp::zeroIfVerySmall(0.5*log($rat));
			}
		}
	}/*}}}*/

    /**
     * Figures out if (value) is in [-epsilon, epsilon]
     */
    private static function isCloseToZero($value) /*{{{*/
    {
        return ($value <= MATH_TRIGOP_EPSILON && $value >= -1*MATH_TRIGOP_EPSILON);
    }/*}}}*/

    /**
     * If (value) is in [-epsilon, epsilon], then return 0 (zero),
     * otherwise return the value unchanged
     */
    private static function zeroIfVerySmall($value) /*{{{*/
    {
        if (Math_TrigOp::isCloseToZero($value)) {
            return 0.0;
        } else {
            return $value;
        }
    }/*}}}*/

}/*}}}*/
?>
