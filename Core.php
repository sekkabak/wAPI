<?php

/**
 * Created by: Cezary Bąk
 */

class Core {

	/* @var array ostatni czas wykonania */
	private $execTime;

	/* @var bool czy zwracać z tłumaczeniem */
	public $translate = true;

	/**
	 * Dekoduje pojedyńczy kod
	 *
	 * @param $code
	 *
	 * @return string
	 */
	public function decodeOneCode( $code ) {
		$start = microtime( true );

		$code       = explode( '-', $code );
		$findsector = (array) $this->getSortingNumber( $code[0] );

		if ( ! isset( $code[1] ) || $findsector[0] === '' || empty( $code[1] ) ) {
			return $this->translate( '' );
		}

		$finded = '';
		foreach ( $findsector as $key ) {
			$tofind = (string) $code[1];
			$cont   = file_get_contents( __DIR__ . '/s/' . $key . '/' . $code[0] );
			if ( strpos( $cont, $tofind ) !== false ) {
				$finded = $key;
				break;
			}
		}

		$this->execTime = microtime( true ) - $start;

		if($this->translate)
		{
			return $this->translate( $finded );
		}
		else
		{
			return $finded;
		}
	}

	/**
	 * Dekoduje array z
	 *
	 * @param $codes array
	 *
	 * @return array
	 */
	public function decodeArrayOfCodes( $codes ) {
		$start  = microtime( true );
		$finded = [];

		foreach ( $codes as $ck => $cv ) {
			$cv         = explode( '-', $cv );
			$findsector = (array) $this->getSortingNumber( $cv[0] );

			// TODO zrobić obsługe wielu nieznalezionych
			$f = '';
			foreach ( $findsector as $key ) {
				$tofind = (string) $cv[1];
				$cont   = file_get_contents( __DIR__ . '/s/' . $key . '/' . $cv[0] );
				if ( strpos( $cont, $tofind ) !== false ) {
					$f = $key;
					break;
				}
			}

			if($this->translate)
			{
				$finded[] = $this->translate( $f );
			}
			else
			{
				$finded[] = $f;
			}
		}


		$this->execTime = microtime( true ) - $start;

		return $finded;
	}

	/**
	 * TODO
	 */
	public function decodeJsonOfCodes() {

	}

	/**
	 * Tłumaczy klucze na nazwy
	 *
	 * @param $key
	 *
	 * @return string
	 */
	private function translate( $key ) {
		static $translation = [
			'mazowieckie',
			'warmińsko-mazurskie',
			'podlaskie',
			'lubelskie',
			'świętokrzyskie',
			'małopolskie',
			'podkarpackie',
			'śląskie',
			'opolskie',
			'dolnośląskie',
			'wielkopolskie',
			'lubuskie',
			'zachodniopomorskie',
			'pomorskie',
			'kujawsko-pomorskie',
			'łódzkie',
			'' => 'nie rozpoznano'
		];

		return $translation[ $key ];
	}

	/**
	 * Dostarczająca numercje
	 *
	 * @param $key
	 *
	 * @return mixed
	 */
	private function getSortingNumber( $key ) {

		if ( ! is_numeric( $key ) || (int) $key > 99 || (int) $key < 00 ) {
			return '';
		}

		if ( strlen( $key ) === 1 ) {
			$key = '0' . $key;
		}

		static $sortArray = [
			'00' => [ 0 ],
			'10' => [ 1 ],
			'20' => [ 3 ],
			'30' => [ 5 ],
			'40' => [ 7 ],
			'01' => [ 0 ],
			'11' => [ 1 ],
			'21' => [ 3 ],
			'31' => [ 5 ],
			'41' => [ 7 ],
			'02' => [ 0 ],
			'12' => [ 1 ],
			'22' => [ 3 ],
			'32' => [ 5 ],
			'42' => [ 7 ],
			'03' => [ 0 ],
			'13' => [ 1 ],
			'23' => [ 3 ],
			'33' => [ 5 ],
			'43' => [ 7 ],
			'04' => [ 0 ],
			'14' => [ 1 ],
			'24' => [ 3 ],
			'34' => [ 5, 7, 10 ],
			'44' => [ 7 ],
			'05' => [ 0 ],
			'15' => [ 2 ],
			'25' => [ 4 ],
			'35' => [ 6 ],
			'45' => [ 7 ],
			'06' => [ 0 ],
			'16' => [ 2 ],
			'26' => [ 0, 4, 15 ],
			'36' => [ 6 ],
			'46' => [ 7 ],
			'07' => [ 0 ],
			'17' => [ 2 ],
			'27' => [ 0, 4 ],
			'37' => [ 6 ],
			'47' => [ 7, 8 ],
			'08' => [ 0, 3 ],
			'18' => [ 2, 0 ],
			'28' => [ 4 ],
			'38' => [ 5, 6 ],
			'48' => [ 8 ],
			'09' => [ 0 ],
			'19' => [ 2, 1 ],
			'29' => [ 4, 6 ],
			'39' => [ 6 ],
			'49' => [ 8 ],
			'50' => [ 9 ],
			'60' => [ 10 ],
			'70' => [ 12 ],
			'80' => [ 13 ],
			'90' => [ 15 ],
			'51' => [ 9 ],
			'61' => [ 10 ],
			'71' => [ 12 ],
			'81' => [ 13 ],
			'91' => [ 15 ],
			'52' => [ 9 ],
			'62' => [ 10 ],
			'72' => [ 12 ],
			'82' => [ 1, 13 ],
			'92' => [ 15 ],
			'53' => [ 9 ],
			'63' => [ 10 ],
			'73' => [ 12 ],
			'83' => [ 13, 14 ],
			'93' => [ 15 ],
			'54' => [ 9 ],
			'64' => [ 10 ],
			'74' => [ 12 ],
			'84' => [ 13 ],
			'94' => [ 15 ],
			'55' => [ 9 ],
			'65' => [ 11 ],
			'75' => [ 12 ],
			'85' => [ 14 ],
			'95' => [ 15 ],
			'56' => [ 9 ],
			'66' => [ 11 ],
			'76' => [ 12, 13 ],
			'86' => [ 14 ],
			'96' => [ 0, 15 ],
			'57' => [ 9 ],
			'67' => [ 9, 11 ],
			'77' => [ 10, 13 ],
			'87' => [ 14 ],
			'97' => [ 15 ],
			'58' => [ 9 ],
			'68' => [ 11 ],
			'78' => [ 12 ],
			'88' => [ 14 ],
			'98' => [ 15 ],
			'59' => [ 9 ],
			'69' => [ 11 ],
			'79' => [],
			'89' => [ 10, 13, 14 ],
			'99' => [ 15 ],
		];

		return $sortArray[ $key ];
	}

	/**
	 * Zwraca ostatni czas wykonania funkcji
	 *
	 * @return array
	 */
	public function getExecTime() {
		return $this->execTime;
	}
}