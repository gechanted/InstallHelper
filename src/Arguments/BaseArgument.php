<?php
declare(strict_types=1);

namespace InstallHelper\Arguments;

use InstallHelper\Output\Description;
use InstallHelper\Output\DescriptionCallable;
use InstallHelper\Output\Question;
use InstallHelper\Output\QuestionCallable;
use InstallHelper\Output\ValueRequiredMessage;
use InstallHelper\Output\ValueRequiredMessageCallable;
use InstallHelper\Validation\BoolValidation;
use InstallHelper\Validation\FloatValidation;
use InstallHelper\Validation\IntValidation;
use InstallHelper\Validation\StringValidation;
use InstallHelper\Validation\ValidatingCallable;

class BaseArgument
{
    public const TYPE_STRING = 'string';
    public const TYPE_BOOLEAN = 'bool';
    public const TYPE_FLAG = 'flag';
    public const TYPE_INT = 'int';
    public const TYPE_FLOAT = 'float';

    public const USAGE_SETTING = 'setting';
    public const USAGE_NON_SETTING = 'non_setting';

    public const USAGE_OPTIONAL = true;
    public const USAGE_REQUIRED = false;

    /**
     * @var string
     */
    private $id;
    /**
     * @var array
     */
    private $cliAccessors;
    /**
     * @var string
     */
    private $type;
    /**
     * @var string
     */
    private $usage;
    /**
     * @var mixed
     */
    private $default;
    /**
     * @var bool
     */
    private $optional;

    /**
     * @var null|callable|ValidatingCallable
     */
    private $validation;
    /**
     * @var string|callable|DescriptionCallable
     */
    private $description;
    /**
     * @var string|callable|ValueRequiredMessageCallable
     */
    private $requiredMessage;
    /**
     * @var string|callable|QuestionCallable
     */
    private $question;

    /**
     * ArgumentVO constructor.
     * @param string $id
     * @param string[] $cliAccessors
     * @param string $type
     * @param string $usage
     * @param bool $optional - if optional is on, if this argument wasn't set it uses the default
     * @param mixed $default
     * @param null|callable|ValidatingCallable $validation
     * @param string|callable|DescriptionCallable $description
     * @param string|callable|ValueRequiredMessageCallable $requiredMessage
     * @param string|callable|QuestionCallable $question
     */
    public function __construct(
        string $id,
        array $cliAccessors = [],
        string $type = BaseArgument::TYPE_STRING,
        string $usage = BaseArgument::USAGE_SETTING,
        bool $optional = BaseArgument::USAGE_REQUIRED,
        $default = null,
        $validation = null,
        $description = null,
        $requiredMessage = null,
        $question = null
    ) {
        $this->id = $id;
        $this->cliAccessors = $cliAccessors;
        $this->type = $type;
        $this->usage = $usage;
        $this->optional = $optional;
        $this->default = $default;

        if ($validation === null) {
            if ($type === self::TYPE_BOOLEAN) {$validation = new BoolValidation();}
            if ($type === self::TYPE_STRING) {$validation = new StringValidation();}
            if ($type === self::TYPE_INT) {$validation = new IntValidation();}
            if ($type === self::TYPE_FLOAT) {$validation = new FloatValidation();}
        }
        $this->validation = $validation;
        if ($description === null) {
            $description = new Description();
        }
        $this->description = $description;
        if ($requiredMessage === null) {
            $requiredMessage = new ValueRequiredMessage();
        }
        $this->requiredMessage = $requiredMessage;
        if ($question === null) {
            $question = new Question();
        }
        $this->question = $question;
    }




    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string[]
     */
    public function getCliAccessors(): array
    {
        return $this->cliAccessors;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getUsage(): string
    {
        return $this->usage;
    }

    public function isOptional(): bool
    {
        return $this->optional;
    }

    /**
     * @return mixed
     */
    public function getDefault()
    {
        return $this->default;
    }

    /**
     * @return callable|QuestionCallable|string
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * @return callable|ValueRequiredMessageCallable|string
     */
    public function getValueRequiredMessage()
    {
        return $this->requiredMessage;
    }

    /**
     * @return callable|DescriptionCallable|string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return callable|ValidatingCallable|null
     */
    public function getValidation()
    {
        return $this->validation;
    }


//-----------------------------------------------------------------------------


    public function setId(string $id): BaseArgument
    {
        $tempId = $this->id;
        $this->id = $id;
        $tempArgument = clone $this;
        $this->id = $tempId;
        return $tempArgument;
    }

    /**
     * @param string[] $cliAccessors
     * @return BaseArgument
     */
    public function setCliAccessors(array $cliAccessors): BaseArgument
    {
        $this->cliAccessors = $cliAccessors;
        return $this;
    }


    public function setType(string $type): BaseArgument
    {
        $this->type = $type;
        return $this;
    }

    public function setUsage(string $usage): BaseArgument
    {
        $this->usage = $usage;
        return $this;
    }

    /**
     * @param mixed $default
     * @return BaseArgument
     */
    public function setDefault($default): BaseArgument
    {
        $this->default = $default;
        return $this;
    }

    public function setOptional(bool $optional): BaseArgument
    {
        $this->optional = $optional;
        return $this;
    }

    /**
     * @param callable|ValidatingCallable|null $validation
     * @return BaseArgument
     */
    public function setValidation($validation): BaseArgument
    {
        $this->validation = $validation;
        return $this;
    }

    /**
     * @param callable|DescriptionCallable|string $description
     * @return BaseArgument
     */
    public function setDescription($description): BaseArgument
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @param callable|ValueRequiredMessageCallable|string $requiredMessage
     * @return BaseArgument
     */
    public function setRequiredMessage($requiredMessage): BaseArgument
    {
        $this->requiredMessage = $requiredMessage;
        return $this;
    }

    /**
     * @param callable|QuestionCallable|string $question
     * @return BaseArgument
     */
    public function setQuestion($question): BaseArgument
    {
        $this->question = $question;
        return $this;
    }

}