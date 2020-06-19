<?php

namespace App\Http\Request;

use Illuminate\Support\Str;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

use App\Http\Exceptions\ValidationException;

class ApplicationRequest extends FormRequest
{
    public function failedValidation(Validator $validator)
    {
        /**
         * Illuminate\Contracts\Validation\Validator does not have getRules() function
         * but $validator is actually an instance of Illuminate\Validation\Validator
         * which has getRules()
         */
        $allRules = $validator->getRules();
        $errorMessages = $validator->errors()->getMessages();
        $failedRules = $validator->failed();

        $allErrors = [];
        foreach ($failedRules as $fieldName => $fieldRules) {
            $i = 0;
            $fieldErrors = [];
            foreach ($fieldRules as $rule => $ruleInfo) {
                $errorObject = [];
                $errorObject['type'] = $this->customizeRuleName(Str::snake($rule), $allRules[$fieldName]);
                $errorObject['description'] = $errorMessages[$fieldName][$i];

                $customizeRuleInfo = $this->getCustomizeRuleInfo(Str::snake($rule), $fieldRules, $ruleInfo);
                $errorObject = array_merge($errorObject, $customizeRuleInfo);

                $fieldErrors [] = $errorObject;
                $i++;
            }
            $allErrors[$fieldName] = $fieldErrors;
        }

        throw new ValidationException($allErrors);
    }

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [];
    }

    private function customizeRuleName(string $ruleName, array $rules)
    {
        switch ($ruleName) {
            case 'max':
                if (in_array('string', $rules)) {
                    return 'max_length';
                } elseif (in_array('array', $rules)) {
                    return 'max_items';
                } elseif (in_array('file', $rules)) {
                    return 'max_size';
                }
                return $ruleName;
            case 'min':
                if (in_array('string', $rules)) {
                    return 'min_length';
                } elseif (in_array('array', $rules)) {
                    return 'min_items';
                } elseif (in_array('file', $rules)) {
                    return 'min_size';
                }
                return $ruleName;
            case 'size':
                if (in_array('array', $rules)) {
                    return 'array_size';
                } elseif (in_array('file', $rules)) {
                    return 'file_size';
                } elseif (in_array('string', $rules)) {
                    return 'string_size';
                } elseif (in_array('numeric', $rules)) {
                    return 'numeric_size';
                }
                return $ruleName;
            case 'phone':
                return 'phone_format';
            case 'price':
                return 'price_format';
            case 'hexadecimal':
                return 'hexadecimal_format';
            case 'percentage':
                return 'percentage_format';
            default:
                return $ruleName;
        }
    }

    private function getCustomizeRuleInfo(string $ruleName, array $rules, array $ruleInfo)
    {
        switch ($ruleName) {
            case 'max':
                return ['limit' => $ruleInfo[0]];
            case 'min':
                return ['limit' => $ruleInfo[0]];
            case 'file':
                return ['limit' => $ruleInfo[0]];
            case 'greater_than':
                return ['limit' => $ruleInfo[0]];
            case 'digits':
                return ['limit' => $ruleInfo[0]];
            case 'digits_between':
                return [
                    'min' => $ruleInfo[0],
                    'max' => $ruleInfo[1]
                ];
            case 'between':
                return [
                    'min' => $ruleInfo[0],
                    'max' => $ruleInfo[1]
                ];
            case 'mimes':
                return ['mimes_types' => $ruleInfo];
            case 'digits':
                return ['length' => $ruleInfo[0]];
            case 'required_without':
                return ['fields' => $ruleInfo];
            case 'required_without_all':
                return ['fields' => $ruleInfo];
            default:
                return [];
        }
    }
}
