<?php namespace Atorscho\Backend\Traits;

trait ModelValidationTrait {

	/**
	 * Validate the Model fields.
	 *
	 * @param array $input
	 *
	 * @return \Illuminate\Validation\Validator
	 */
	public function validates( $input )
	{
		$rules = [ ];

		if ( isset( $this->rules ) )
		{
			$rules = $this->rules;
		}

		if ( isset( $this->id ) )
		{
			foreach ( $rules as $i => $rule )
			{
				if ( is_string($rule) && strpos($rule, 'unique') === false )
					continue;

				if ( is_string($rule) )
					$rule = explode('|', $rule);

				foreach ( $rule as $j => $str )
				{
					if ( strpos($str, 'unique') !== false )
					{
						if ( substr_count($str, ',') === 0 )
							$str .= ',' . $i;

						$rule[$j] = $str . ',' . $this->id;
					}
				}

				$rules[$i] = $rule;
			}
		}

		return \Validator::make($input, $rules);
	}

}
