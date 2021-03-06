<?php
/**
 * Phanbook : Delightfully simple forum and Q&A software
 *
 * Licensed under The GNU License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @link    http://phanbook.com Phanbook Project
 * @since   1.0.0
 * @author  Phanbook <hello@phanbook.com>
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.txt
 */
namespace Phanbook\Frontend\Controllers;

/**
 * Class TestsController
 *
 * @package Phanbook\Frontend\Controllers
 */
class TestsController extends ControllerBase
{

    /**
     * indexAction function.
     *
     * @return string
     */
    public function indexAction()
    {
        d($this->router);
        return 'frontend';

    }
    public function testLoggerAction()
    {
        $this->view->disable();
        try {
            $nonExistingComponent = $this->getDI()->get('nonExistingComponent');
            $nonExistingComponent->executeNonExistingMethod();
        } catch (\Exception $e) {
            $this->logger->error($e->getMessage());
        }
    }
}
