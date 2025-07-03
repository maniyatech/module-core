<?php
/**
 * ManiyaTech
 *
 * @author        Milan Maniya
 * @package       ManiyaTech_Core
 */

declare(strict_types=1);

namespace ManiyaTech\Core\Block\Adminhtml\System\Config\Composer;

use Magento\Backend\Block\Template\Context;
use Magento\Config\Block\System\Config\Form\Field;
use Magento\Framework\Data\Form\Element\AbstractElement;
use ManiyaTech\Core\Model\Module;

class Version extends Field
{
    /**
     * @var Module
     */
    private Module $module;

    /**
     * Constructor.
     *
     * @param Context $context
     * @param Module $module
     * @param array $data
     */
    public function __construct(
        Context $context,
        Module $module,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->module = $module;
    }

    /**
     * Remove scope label and render the field as HTML.
     *
     * @param AbstractElement $element
     * @return string
     */
    public function render(AbstractElement $element): string
    {
        // Hide scope labels for clarity
        $element->unsScope()
            ->unsCanUseWebsiteValue()
            ->unsCanUseDefaultValue();

        return parent::render($element);
    }

    /**
     * Return the installed version as value in the config field.
     *
     * @param AbstractElement $element
     * @return string
     */
    protected function _getElementHtml(AbstractElement $element): string
    {
        // Try to extract module name from the field ID if prefixed
        $elementId = (string)$element->getOriginalData('id');
        $moduleName = str_starts_with($elementId, 'ManiyaTech_')
            ? $elementId
            : $this->getModuleName();

        return '<strong>'.'v' . $this->module->getInstalledVersion($moduleName).'</strong>';
    }
}
