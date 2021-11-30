<?php
namespace Digital\Requestinfo\Block\Adminhtml\Requestinfo;

/**
 * Adminhtml Requestinfo grid
 */
class Grid extends \Magento\Backend\Block\Widget\Grid\Extended
{
    /**
     * @var \Digital\Requestinfo\Model\ResourceModel\Requestinfo\CollectionFactory
     */
    protected $_collectionFactory;

    /**
     * @var \Digital\Requestinfo\Model\Requestinfo
     */
    protected $_requestinfo;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Backend\Helper\Data $backendHelper
     * @param \Digital\Requestinfo\Model\Requestinfo $requestinfoPage
     * @param \Digital\Requestinfo\Model\ResourceModel\Requestinfo\CollectionFactory $collectionFactory
     * @param \Magento\Core\Model\PageLayout\Config\Builder $pageLayoutBuilder
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Backend\Helper\Data $backendHelper,
        \Digital\Requestinfo\Model\Requestinfo $requestinfo,
        \Digital\Requestinfo\Model\ResourceModel\Requestinfo\CollectionFactory $collectionFactory,
        array $data = []
    ) {
        $this->_collectionFactory = $collectionFactory;
        $this->_requestinfo = $requestinfo;
        parent::__construct($context, $backendHelper, $data);
    }

    /**
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('requestinfoGrid');
        $this->setDefaultSort('requestinfo_id');
        $this->setDefaultDir('DESC');
        $this->setUseAjax(true);
        $this->setSaveParametersInSession(true);
    }

    /**
     * Prepare collection
     *
     * @return \Magento\Backend\Block\Widget\Grid
     */
    protected function _prepareCollection()
    {
        $collection = $this->_collectionFactory->create();
        /* @var $collection \Digital\Requestinfo\Model\ResourceModel\Requestinfo\Collection */
        $this->setCollection($collection);

        return parent::_prepareCollection();
    }

    /**
     * Prepare columns
     *
     * @return \Magento\Backend\Block\Widget\Grid\Extended
     */
    protected function _prepareColumns()
    {
        $this->addColumn('requestinfo_id', [
            'header'    => __('ID'),
            'index'     => 'requestinfo_id',
        ]);
        $this->addColumn('sapcustomerid', ['header' => __('SAP Customer ID'), 'index' => 'sapcustomerid']);
        $this->addColumn('name', ['header' => __('Name'), 'index' => 'name']);
        $this->addColumn('phone', ['header' => __('Phone'), 'index' => 'phone']);
        $this->addColumn('email', ['header' => __('Email'), 'index' => 'email']);
       /* $this->addColumn('detailsofchangesrequired', ['header' => __('Details of changes required'), 'index' => 'detailsofchangesrequired']);*/
        $this->addColumn('count', ['header' => __('Count'), 'index' => 'count']);
        $this->addColumn(
            'exported',
            [
                'header' => __('Exported'),
                'index' => 'exported',
            ]
        );
        /*$this->addColumn('response', ['header' => __('Response'), 'index' => 'response']);*/
        $this->addColumn(
            'date',
            [
                'header' => __('Date'),
                'index' => 'date',
                'type' => 'datetime',
                'header_css_class' => 'col-date',
                'column_css_class' => 'col-date'
            ]
        );
        
        $this->addColumn(
            'action',
            [
                'header' => __('View'),
                'type' => 'action',
                'getter' => 'getId',
                'actions' => [
                    [
                        'caption' => __('View'),
                        'url' => [
                            'base' => '*/*/edit',
                            'params' => ['store' => $this->getRequest()->getParam('store')]
                        ],
                        'field' => 'requestinfo_id'
                    ]
                ],
                'sortable' => false,
                'filter' => false,
                'header_css_class' => 'col-action',
                'column_css_class' => 'col-action'
            ]
        );

        return parent::_prepareColumns();
    }

    /**
     * Row click url
     *
     * @param \Magento\Framework\Object $row
     * @return string
     */
    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', ['requestinfo_id' => $row->getId()]);
    }

    /**
     * Get grid url
     *
     * @return string
     */
    public function getGridUrl()
    {
        return $this->getUrl('*/*/grid', ['_current' => true]);
    }
}
