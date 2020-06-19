<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('without_spaces', function ($attribute, $value) {
            return preg_match('/^\S*$/u', $value);
        }, 'The :attribute must be without spaces.');

        Validator::extend('matched_id', function ($attribute, $value, $parameters) {
            return $value == $parameters[0];
        }, 'The :attribute in url must be matched with the :attribute in body.');

        Validator::extend('percentage', function ($attribute, $value) {
            return preg_match('/^\d{1,3}(\.\d{1,2})?$/', $value);
        }, 'The :attribute format is invalid. ex:100.00');

        Validator::extend('not_present', function ($attribute, $value, $parameters, $validator) {
            return !array_key_exists($attribute, $validator->attributes());
        }, 'The :attribute is not editable.');

        Validator::extend('hexadecimal', function ($attribute, $value) {
            return preg_match('/^#([a-fA-F0-9]{6}|[a-fA-F0-9]{8}|[a-fA-F0-9]{3}|[a-fA-F0-9]{4})$/', $value);
        }, 'The :attribute format is invalid hexdecimal.');

        Validator::extend('price', function ($attribute, $value) {
            return preg_match('/^\d{1,10}(\.\d{1,2})?$/', $value);
        }, 'The :attribute format is invalid. ex:7.00');

        Validator::extend('phone', function ($attribute, $value) {
            return preg_match('/^[0-9]+$/', $value);
        }, 'The :attribute format is invalid phone nubmer.');

        Validator::extend('greater_than', function ($attribute, $value, $parameters, $validator) {

            $validator->addReplacer('greater_than', function ($message, $attribute, $rule, $parameters) {
                return str_replace([':min'], $parameters, $message);
            });

            return $value > $parameters[0];
        }, 'The :attribute value must be greater than :min.');
    }
}
