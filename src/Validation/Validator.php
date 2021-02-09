<?php

declare(strict_types=1);

namespace Light\Validation;

class Validator
{
    private array $errors = [];

    /**
     * @param  mixed[]  $data
     * @param  mixed[]  $rules
     *
     * @return string[][]
     * @throws \Exception
     */
    public function validate(array $data, array $rules): array
    {
        foreach ($rules as $key => $rulesByField) {
            foreach($rulesByField as $rule) {
                if (is_array($rule)) {
                    $method = $rule[0];
                    if (method_exists($this, $method)) {
                        $this->$method($key, $data[$key], $rule[1]);
                    } else {
                        throw new \Exception('Wrong rule');
                    }
                } else {
                    if (method_exists($this, $rule)) {
                        $this->$rule($key, $data[$key]);
                    } else {
                        throw new \Exception('Wrong rule');
                    }
                }
            }
        }

        return $this->errors;
    }

    private function notEmpty(string $field, mixed $data) : void
    {
        if (!isset($data) || empty($data)) {
            $this->errors[$field]['notEmpty'] = "The {$field} field is empty";
        }
    }

    private function date(string $field, string $data) : void
    {
        if (!date_create_from_format('Y-m-d', $data)) {
            $this->errors[$field]['date'] = "Wrong date format";
        }
    }

    private function maxLength(string $field, string $data, int $length) : void
    {
        if (strlen($data) > $length) {
            $this->errors[$field]['maxLength'] = "This {$field} is more then {$length}";
        }
    }

    private function equals(string $field, string $data, string $value) : void
    {
        if ($data !== $value) {
            $this->errors[$field]['maxLength'] = "Passwords are not same";
        }
    }

    /**
     * @param  string  $field
     * @param  int|float  $data
     * @param  int[]|float[]  $range
     */
    private function inRange(string $field, int|float $data, array $range) : void
    {
        if (!in_array($data, range($range[0], $range[1]))) {
            $this->errors[$field]['inRange'] = "This {$field} must be between {$range[0]} and {$range[1]}";
        }
    }
}
