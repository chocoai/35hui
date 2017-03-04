<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FetchSouFun
 *
 * @author skding
 */
class FetchSouFun {
    /**
	 * Returns the instance of CFile for the specified file.
	 *
	 * @param string $url Path to file for fech
     * @param string $type The typ of the conetnt
	 * @return object fech content
	 */
    public static function Factory($sell_rent,$type='office'){
        switch ($type){
            case 'office':
                return new SouFunOffice($sell_rent);
            break;
            case 'shop':
                return new SouFunShop($sell_rent);
            break;
            case 'housing':
                return new SouFunHousing($sell_rent);
            break;
        }
    }
}
