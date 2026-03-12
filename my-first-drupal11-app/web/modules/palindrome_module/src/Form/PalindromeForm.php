<?php

namespace Drupal\palindrome_module\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class PalindromeForm extends FormBase
{

    public function getFormId()
    {
        return 'palindrome_form';
    }

    public function buildForm(array $form, FormStateInterface $form_state)
    {

        $form['text'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Enter text'),
            '#required' => TRUE,
        ];

        $form['submit'] = [
            '#type' => 'submit',
            '#value' => $this->t('Check'),
        ];

        return $form;
    }

    public function submitForm(array &$form, FormStateInterface $form_state)
    {

        $text = $form_state->getValue('text');

        $clean = strtolower(preg_replace('/[^a-z0-9]/', '', $text));
        $reverse = strrev($clean);

        if ($clean == $reverse) {
            \Drupal::messenger()->addMessage($text . ' is a palindrome');
        } else {
            \Drupal::messenger()->addMessage($text . ' is NOT a palindrome');
        }
    }
}
