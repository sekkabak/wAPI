<?php

/**
 * Created by: Cezary Bąk
 */

class Core {

	/* @var array last function execution time */
	private $execTime;

	public function decodeOneCode( $code ) {
		// start count time
		$start = microtime( true );

		$code = explode( '-', $code );

		$findsector = (array) $this->getSortingNumber($code[0]);
		$finded     = '';

		foreach ( $findsector as $key ) {
			$tofind = (string) $code[1];
			$cont   = file_get_contents( __DIR__ . '/s/' . $key . '/' . $code[0] );
			if ( strpos( $cont, $tofind ) !== false ) {
				$finded = $key;
				break;
			}
		}

		// end count time and set
		$this->execTime = microtime( true ) - $start;

		// return translated value
		return $this->translate( $finded );
	}

	public function decodeArrayOfCodes($code) {

	}

	public function decodeJsonOfCodes() {

	}

	/**
	 * Eksperymentalna metoda tworząca biblioteke
	 */
	/*
	public function cutToLibrary() {
		foreach ( self::$states as $key => $value ) {
			$path = __DIR__ . '/s/' . $key;
			mkdir( $path, 0777, true );
			foreach ( $value as $k => $v ) {
				$myfile = fopen( $path . '/' . $k, "wr" ) or die( 'Unable to open file!' );
				fwrite( $myfile, $v );
				fclose( $myfile );
			}
		}
	}
	*/

	/**
	 * Metoda tłumacząca
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
	 * Metoda dostarczająca numercje
	 *
	 * @param $key
	 *
	 * @return mixed
	 */
	private function getSortingNumber( $key ) {
		static $sortArray = [
			'00' => [ 0 ],
			'01' => [ 0 ],
			'02' => [ 0 ],
			'03' => [ 0 ],
			'04' => [ 0 ],
			'05' => [ 0 ],
			'06' => [ 0 ],
			'07' => [ 0 ],
			'08' => [ 0, 3 ],
			'09' => [ 0 ],
			'10' => [ 1 ],
			'11' => [ 1 ],
			'12' => [ 1 ],
			'13' => [ 1 ],
			'14' => [ 1 ],
			'15' => [ 2 ],
			'16' => [ 2 ],
			'17' => [ 2 ],
			'18' => [ 2, 0 ],
			'19' => [ 2, 1 ],
			'20' => [ 3 ],
			'21' => [ 3 ],
			'22' => [ 3 ],
			'23' => [ 3 ],
			'24' => [ 3 ],
			'25' => [ 4 ],
			'26' => [ 0, 4, 15 ],
			'27' => [ 0, 4 ],
			'28' => [ 4 ],
			'29' => [ 4, 6 ],
			'30' => [ 5 ],
			'31' => [ 5 ],
			'32' => [ 5 ],
			'33' => [ 5 ],
			'34' => [ 5, 7, 10 ],
			'35' => [ 6 ],
			'36' => [ 6 ],
			'37' => [ 6 ],
			'38' => [ 5, 6 ],
			'39' => [ 6 ],
			'40' => [ 7 ],
			'41' => [ 7 ],
			'42' => [ 7 ],
			'43' => [ 7 ],
			'44' => [ 7 ],
			'45' => [ 7 ],
			'46' => [ 7 ],
			'47' => [ 7, 8 ],
			'48' => [ 8 ],
			'49' => [ 8 ],
			'50' => [ 9 ],
			'51' => [ 9 ],
			'52' => [ 9 ],
			'53' => [ 9 ],
			'54' => [ 9 ],
			'55' => [ 9 ],
			'56' => [ 9 ],
			'57' => [ 9 ],
			'58' => [ 9 ],
			'59' => [ 9 ],
			'60' => [ 10 ],
			'61' => [ 10 ],
			'62' => [ 10 ],
			'63' => [ 10 ],
			'64' => [ 10 ],
			'65' => [ 11 ],
			'66' => [ 11 ],
			'67' => [ 9, 11 ],
			'68' => [ 11 ],
			'69' => [ 11 ],
			'70' => [ 12 ],
			'71' => [ 12 ],
			'72' => [ 12 ],
			'73' => [ 12 ],
			'74' => [ 12 ],
			'75' => [ 12 ],
			'76' => [ 12, 13 ],
			'77' => [ 10, 13 ],
			'78' => [ 12 ],
			'79' => [],
			'80' => [ 13 ],
			'81' => [ 13 ],
			'82' => [ 1, 13 ],
			'83' => [ 13, 14 ],
			'84' => [ 13 ],
			'85' => [ 14 ],
			'86' => [ 14 ],
			'87' => [ 14 ],
			'88' => [ 14 ],
			'89' => [ 10, 13, 14 ],
			'90' => [ 15 ],
			'91' => [ 15 ],
			'92' => [ 15 ],
			'93' => [ 15 ],
			'94' => [ 15 ],
			'95' => [ 15 ],
			'96' => [ 0, 15 ],
			'97' => [ 15 ],
			'98' => [ 15 ],
			'99' => [ 15 ],
		];

		return $sortArray[ $key ];
	}

	public function getExecTime() {
		return $this->execTime;
	}
}