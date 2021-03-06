<?php
namespace Market\Form;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Input;
use Zend\Validator\Regex;

class PostFilter extends InputFilter
{
    
    use ExpireDaysTrait;

    public $categories;

    public function setCategories($categories)
    {
        $this->categories = $categories;
    }

    public function buildFilter()
    {
        $category = new Input('category');
        $category->getFilterChain()
            ->attachByName('StringTrim')
            ->attachByName('StripTags')
            ->attachByName('StringToLower');
        $category->getValidatorChain()->attachByName('InArray', array(
            'haystack' => $this->categories
        ));
        
        $title = new Input('title');
        $title->getFilterChain()
            ->attachByName('StringTrim')
            ->attachByName('StripTags');
        
        $titleRegex = new Regex(array(
            'pattern' => '/^[a-zA-Z\d]+$/'
        ));
        $titleRegex->setMessage('Title should only contain numbers, letters or spaces');
        
        $title->getValidatorChain()
            ->attach($titleRegex)
            ->attachByName('StringLength', array(
            'min' => 1,
            'max' => 128
        ));
        
        $expires = new Input('expires');
        $expires->setAllowEmpty(TRUE);
        $expires->getValidatorChain()->attachByName('InArray', array(
            'haystack' => array_keys($this->getExpireDays())
        ));
        $expires->getFilterChain()
            ->attachByName('StripTags')
            ->attachByName('StringTrim');
        
        $this->add($category)
            ->add($title)
            ->add($expires);
    }
}
