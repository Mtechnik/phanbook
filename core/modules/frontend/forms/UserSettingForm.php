<?php
/**
 * Phanbook : Delightfully simple forum software
 *
 * Licensed under The GNU License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @link    http://phanbook.com Phanbook Project
 * @since   1.0.0
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.txt
 */
namespace Phanbook\Frontend\Forms;

use Phanbook\Models\Users;
use Phalcon\Forms\Element\File;
use Phalcon\Forms\Element\Select;
use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Forms\Element\Submit;
use Phalcon\Forms\Element\Radio;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Email;
use Phalcon\Validation\Validator\Regex;
use Phalcon\Validation\Validator\Identical;
use Phalcon\Forms\Element\TextArea;

class UserSettingForm extends Form
{
    public function initialize($entity = null)
    {
        // In edit page the id is hidden
        if (!is_null($entity)) {
            $this->add(new Hidden('id'));
        }


        //Phannook weekly digest
        if (!empty($entity) && $entity->getDigest() == Users::DIGEST_YES || $this->request->getPost('digestYes') == Users::DIGEST_YES) {
            $this->add(new Radio('digestYes', ['value' => Users::DIGEST_YES, 'checked' => 'checked', 'name' => 'digest']));
        } else {
            $this->add(new Radio('digestYes', ['value' => Users::DIGEST_YES, 'name' => 'digest']));
        }

        if (!empty($entity) && $entity->getDigest() == Users::DIGEST_NO || $this->request->getPost('digest') == Users::DIGEST_NO) {
            $this->add(new Radio('digestNo', ['value' => Users::DIGEST_NO, 'checked' => 'checked', 'name' => 'digest']));
        } else {
            $this->add(new Radio('digestNo', ['value' => Users::DIGEST_NO, 'name' => 'digest']));
        }

        //notification
        $this->add(new Select(
            'notifications',
            [
                Users::NOTIFY_N => 'Never receive an e-mail notification',
                Users::NOTIFY_Y => 'Receive e-mail notifications from all new threads and comments',
                Users::NOTIFY_P => 'When someone replies to a discussion that I started or replied to'
            ]
        ));

        //timezone
        $timezones = require ROOT_DIR .'core/config/timezone.php';
        $this->add(new Select('timezone', $timezones));

        //Submit
        $this->add(
            new Submit(
                'save',
                [
                'value' => 'Save',
                'class' => 'btn btn-sm btn-info'
                ]
            )
        );
        $this->add(
            new Submit(
                'saveAvatar',
                [
                'value' => 'Change avatar',
                'class' => 'btn btn-sm btn-info'
                ]
            )
        );
    }
}
