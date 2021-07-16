<?php

namespace App\Rules;

use App\Models\Like;
use Illuminate\Contracts\Validation\Rule;

class UniqueLike implements Rule
{
    private $user_id;
    private $id;
    private $type;

    /**
     * Create a new rule instance.
     *
     * @param $user_id
     * @param $id
     * @param $type
     */
    public function __construct($user_id, $id, $type)
    {
        $this->user_id = $user_id;
        $this->id = $id;
        $this->type = $type;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $exists = Like::where('user_id', $this->user_id)
            ->where('likeable_id', $this->id)
            ->where('likeable_type', $this->type)
            ->first();

        return $exists == null;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'You have already voted!';
    }
}
