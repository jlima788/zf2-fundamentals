<?php
namespace Market\Form;

use Zend\Form\Form;
use Zend\Form\Element\Select;
use Zend\Form\Element\Text;
use Zend\Form\Element\Radio;
use Zend\Form\Element\Email;
use Zend\Form\Element\Textarea;
use Zend\Form\Element\Submit;

class PostForm extends Form
{
    
    use ExpireDaysTrait;

    private $categories;

    public function setCategories($categories)
    {
        $this->categories = $categories;
    }

    public function buildForm()
    {
        $this->setAttribute("method", "POST");
        
        $category = new Select('category');
        $category->setLabel('Category')->setValueOptions(array_combine($this->categories, $this->categories));
        
        $title = new Text('title');
        $title->setLabel("Title")->setAttributes(array(
            'size' => 25,
            'maxLenth' => 128
        ));
        
        $photo = new Text('photo_filename');
        $photo->setLabel('Photo')
            ->setAttribute('maxlength', 1024)
            ->setAttribute('placeholder', 'Enter URL of a JPG');
        
        $price = new Text('price');
        $price->setLabel('Price')
            ->setAttribute('title', 'Enter price as nnn.nn')
            ->setAttribute('size', 16)
            ->setAttribute('maxlength', 16)
            ->setAttribute('placeholder', 'Enter some value');
        
        $expires = new Radio('expires');
        $expires->setLabel('Expires')
            ->setAttribute('title', 'The expiration date will be calculated from today')
            ->setAttribute('class', 'expiresButton')
            ->setValueOptions([
            $this->getExpireDays()
        ]);
        
        $city = new Text('cityCode');
        $city->setLabel('Nearest City')
            ->setAttribute('title', 'Select the city of the item')
            ->setAttribute('id', 'cityCode')
            ->setAttribute('placeholder', 'Start typing and choose the city');
        
        $name = new Text('contact_name');
        $name->setLabel('Contact Name')
            ->setAttribute('title', 'Enter the name of the person to contact for this item')
            ->setAttribute('size', 40)
            ->setAttribute('maxlength', 255);
        
        $phone = new Text('contact_phone');
        $phone->setLabel('Contact Phone Number')
            ->setAttribute('title', 'Enter the phone number of the person to contact for this item')
            ->setAttribute('size', 20)
            ->setAttribute('maxlength', 32);
        
        $email = new Email('contact_email');
        $email->setLabel('Contact Email')
            ->setAttribute('title', 'Enter the email address of the person to contact for this item')
            ->setAttribute('size', 40)
            ->setAttribute('maxlength', 255);
        
        $description = new Textarea('description');
        $description->setLabel('Description')
            ->setAttribute('title', 'Enter a suitable description for this posting')
            ->setAttribute('rows', 4)
            ->setAttribute('cols', 80);
        
        $delCode = new Text('delete_code');
        $delCode->setLabel('Delete Code')
            ->setAttribute('title', 'Enter the delete code for this item')
            ->setAttribute('size', 16)
            ->setAttribute('maxlength', 16);
        
        $submit = new Submit('submit');
        $submit->setAttribute('value', 'Post');
        
        $this->add($category)
            ->add($title)
            ->add($photo)
            ->add($price)
            ->add($expires)
            ->add($city)
            ->add($name)
            ->add($phone)
            ->add($email)
            ->add($description)
            ->add($delCode)
            ->add($submit);
    }
}
