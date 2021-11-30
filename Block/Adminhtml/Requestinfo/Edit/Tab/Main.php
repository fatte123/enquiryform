<?php
namespace Digital\Requestinfo\Block\Adminhtml\Requestinfo\Edit\Tab;

/**
 * Cms page edit form main tab
 */
class Main extends \Magento\Backend\Block\Widget\Form\Generic implements \Magento\Backend\Block\Widget\Tab\TabInterface
{
    /**
     * @var \Magento\Store\Model\System\Store
     */
    protected $_systemStore;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Data\FormFactory $formFactory
     * @param \Magento\Store\Model\System\Store $systemStore
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magento\Store\Model\System\Store $systemStore,
        array $data = []
    ) {
        $this->_systemStore = $systemStore;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * Prepare form
     *
     * @return $this
     */
    protected function _prepareForm()
    {
        /* @var $model \Magento\Cms\Model\Page */
        $model = $this->_coreRegistry->registry('requestinfo');

        /*
         * Checking if user have permissions to save information
         */
        if ($this->_isAllowedAction('Digital_Requestinfo::save')) {
            $isElementDisabled = false;
        } else {
            $isElementDisabled = true;
        }

        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create();

        $form->setHtmlIdPrefix('requestinfo_main_');

        $fieldset = $form->addFieldset('base_fieldset', ['legend' => __('Requestinfo Information')]);

        if ($model->getId()) {
            $fieldset->addField('requestinfo_id', 'hidden', ['name' => 'requestinfo_id']);
        }

        $fieldset->addField(
            'sapcustomerid',
            'label',
            [
                'name' => 'sapcustomerid',
                'label' => __('SAP Customer ID  :'),
                'title' => __('SAP Customer ID')
            ]
        );

        $fieldset->addField(
            'name',
            'label',
            [
                'name' => 'name',
                'label' => __('Name  :'),
                'title' => __('Name')
            ]
        );
         $fieldset->addField(
            'phone',
            'label',
            [
                'name' => 'phone',
                'label' => __('phone  :'),
                'title' => __('phone')
            ]
        );
         $fieldset->addField(
            'email',
            'label',
            [
                'name' => 'email',
                'label' => __('Email  :'),
                'title' => __('email')
            ]
        );

         $fieldset->addField(
            'detailsofchangesrequired',
            'label',
            [
                'name' => 'detailsofchangesrequired',
                'label' => __('Details of changes required  :'),
                'title' => __('Details of changes required')
            ]
        );
         
        $fieldset->addField(
            'count',
            'label',
            [
                'name' => 'count',
                'label' => __('Count  :'),
                'title' => __('count')
            ]
        );
        
         
         $fieldset->addField(
            'response',
            'label',
            [
                'name' => 'response',
                'label' => __('Response  :'),
                'title' => __('response')
            ]
        );

         $fieldset->addField(
            'date',
            'label',
            [
                'name' => 'date',
                'label' => __('Date  :'),
                'title' => __('date')
            ]
        );
         $fieldset->addField(
            'exported',
            'label',
            [
                'name' => 'exported',
                'label' => __('Exported  :'),
                'title' => __('exported'),
            ]
        );
        
        $this->_eventManager->dispatch('adminhtml_requestinfo_edit_tab_main_prepare_form', ['form' => $form]);

        $form->setValues($model->getData());
        $this->setForm($form);

        return parent::_prepareForm();
    }

    /**
     * Prepare label for tab
     *
     * @return string
     */
    public function getTabLabel()
    {
        return __('Requestinfo Information');
    }

    /**
     * Prepare title for tab
     *
     * @return string
     */
    public function getTabTitle()
    {
        return __('Requestinfo Information');
    }

    /**
     * {@inheritdoc}
     */
    public function canShowTab()
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function isHidden()
    {
        return false;
    }

    /**
     * Check permission for passed action
     *
     * @param string $resourceId
     * @return bool
     */
    protected function _isAllowedAction($resourceId)
    {
        return $this->_authorization->isAllowed($resourceId);
    }
}
