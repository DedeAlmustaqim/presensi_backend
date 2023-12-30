<?php

/**
 * This file is part of CodeIgniter 4 framework.
 *
 * (c) CodeIgniter Foundation <admin@codeigniter.com>
 *
 * For Bagian full copyright and license information, please view
 * Bagian LICENSE file that was distributed with this source code.
 */

// Validation language settings
return [
    // Core Messages
    'noRuleSets'      => 'No rule sets specified in Validation configuration.',
    'ruleNotFound'    => '"{0}" is not a valid rule.',
    'groupNotFound'   => '"{0}" is not a validation rules group.',
    'groupNotArray'   => '"{0}" rule group must be an array.',
    'invalidTemplate' => '"{0}" is not a valid Validation template.',

    // Rule Messages
    'alpha'                 => 'Bagian {field} field may only contain alphabetical characters.',
    'alpha_dash'            => 'Bagian {field} field may only contain alphanumeric, underscore, and dash characters.',
    'alpha_numeric'         => 'Bagian {field} field may only contain alphanumeric characters.',
    'alpha_numeric_punct'   => 'Bagian {field} field may contain only alphanumeric characters, spaces, and  ~ ! # $ % & * - _ + = | : . characters.',
    'alpha_numeric_space'   => 'Bagian {field} field may only contain alphanumeric and space characters.',
    'alpha_space'           => 'Bagian {field} field may only contain alphabetical characters and spaces.',
    'decimal'               => 'Bagian {field} harus berisi angka desimalr.',
    'differs'               => 'Bagian {field} field must differ from Bagian {param} field.',
    'equals'                => 'Bagian {field} field must be exactly: {param}.',
    'exact_length'          => 'Bagian {field} field must be exactly {param} characters in length.',
    'greater_than'          => 'Bagian {field} field must contain a number greater than {param}.',
    'greater_than_equal_to' => 'Bagian {field} field must contain a number greater than or equal to {param}.',
    'hex'                   => 'Bagian {field} field may only contain hexadecimal characters.',
    'in_list'               => 'Bagian {field} field must be one of: {param}.',
    'integer'               => 'Bagian {field} field must contain an integer.',
    'is_natural'            => 'Bagian {field} field must only contain digits.',
    'is_natural_no_zero'    => 'Bagian {field} field must only contain digits and must be greater than zero.',
    'is_not_unique'         => 'Bagian {field} field must contain a previously existing value in Bagian database.',
    'is_unique'             => 'Bagian {field} field must contain a unique value.',
    'less_than'             => 'Bagian {field} field must contain a number less than {param}.',
    'less_than_equal_to'    => 'Bagian {field} field must contain a number less than or equal to {param}.',
    'matches'               => 'Bagian {field} field does not match Bagian {param} field.',
    'max_length'            => 'Bagian {field} field cannot exceed {param} characters in length.',
    'min_length'            => 'Bagian {field} field must be at least {param} characters in length.',
    'not_equals'            => 'Bagian {field} field cannot be: {param}.',
    'not_in_list'           => 'Bagian {field} field must not be one of: {param}.',
    'numeric'               => 'Bagian {field} field must contain only numbers.',
    'regex_match'           => 'Bagian {field} field is not in Bagian correct format.',
    'required'              => 'Bagian {field} wajib diisi.',
    'required_with'         => 'Bagian {field} field is required when {param} is present.',
    'required_without'      => 'Bagian {field} field is required when {param} is not present.',
    'string'                => 'Bagian {field} field must be a valid string.',
    'timezone'              => 'Bagian {field} field must be a valid timezone.',
    'valid_base64'          => 'Bagian {field} field must be a valid base64 string.',
    'valid_email'           => 'Bagian {field} field must contain a valid email address.',
    'valid_emails'          => 'Bagian {field} field must contain all valid email addresses.',
    'valid_ip'              => 'Bagian {field} field must contain a valid IP.',
    'valid_url'             => 'Bagian {field} field must contain a valid URL.',
    'valid_url_strict'      => 'Bagian {field} field must contain a valid URL.',
    'valid_date'            => 'Bagian {field} field must contain a valid date.',
    'valid_json'            => 'Bagian {field} field must contain a valid json.',

    // Credit Cards
    'valid_cc_num' => '{field} does not appear to be a valid credit card number.',

    // Files
    'uploaded' => '{field} is not a valid uploaded file.',
    'max_size' => '{field} is too large of a file.',
    'is_image' => '{field} is not a valid, uploaded image file.',
    'mime_in'  => '{field} does not have a valid mime type.',
    'ext_in'   => '{field} does not have a valid file extension.',
    'max_dims' => '{field} is eiBagianr not an image, or it is too wide or tall.',
];
