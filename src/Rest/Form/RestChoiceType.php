<?php
/**
 * Created by PhpStorm.
 * User: nikolns
 * Date: 7/4/19
 * Time: 12:13 PM
 */

namespace App\Rest\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class RestSelectChoice
 *
 * @package App\Form
 */
class RestChoiceType extends AbstractType
{
//region SECTION: Fields
    public const REST_DESCRIPTION    = 'rest_description';
    public const REST_CHOICES        = 'rest_choices';
    public const REST_COMPONENT_NAME = 'rest_component_name';
//endregion Fields

//region SECTION: Public
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add(
            $options[self::REST_COMPONENT_NAME],
            ChoiceType::class,
            [
                'documentation' => [
                    'description' => $options[self::REST_DESCRIPTION],
                    'in'          => 'body',
                ],
                'choices'       => $options[self::REST_CHOICES],
            ]
        )->addViewTransformer(
            new CallbackTransformer(
                function ($value) {
                    // transform the array to a string
                    return $value === '' ? null : $value;
                },
                function ($value) {
                    // transform the string back to an array
                    return $value ?? '';
                }
            )
        );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setRequired([self::REST_COMPONENT_NAME, self::REST_CHOICES, self::REST_DESCRIPTION]);
        $resolver->setDefault('compound', true);
    }
//endregion Public

//region SECTION: Getters/Setters
    public function getParent()
    {
        return ChoiceType::class;
    }
//endregion Getters/Setters
}