<?php

namespace Block\Admin\Cart;

\Mage::loadFileByClassName("Block\Core\Grid");

class Grid extends \Block\Core\Grid
{

    protected $customerList = [];
    protected $products = [];

    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('./view/admin/cart/grid.php');
    }
    public function prepareCollection()
    {
        $cart = \Mage::getModel("Model\Cart");
        if ($this->getFilterObject()->getFilters()) {
            $collection = $cart->fetchAll($this->buildFilterQuery('cart_item'))->getData();
        } else {
            $collection = $cart->getCart($this->getActiveCustomerId())->getItems();
            if ($collection) {
                $collection = $collection->getdata();
            }
        }
        $this->setCollection($collection);
        return $this;
    }

    public function getTableName()
    {
        return \Mage::getModel('Model\Cart')->getTableName();
    }

    public function prepareColumns()
    {
        $tableName = $this->getTableName();
        $this->addColumns('cartItemId', [
            'field' => 'cartItemId',
            'label' => '#',
            'type' => 'number',
            'filter' => $this->getFilterObject()->getFilters($tableName, 'cartItemId')['cartItemId'],
        ]);
        $this->addColumns('cartId', [
            'field' => 'cartId',
            'label' => 'Cart Id',
            'type' => 'number',
            'filter' => $this->getFilterObject()->getFilters($tableName, 'cartId')['cartId'],
        ]);
        $this->addColumns('productId', [
            'field' => 'productId',
            'label' => 'Product Id',
            'type' => 'number',
            'filter' => $this->getFilterObject()->getFilters($tableName, 'productId')['productId'],
        ]);
        $this->addColumns('productName', [
            'field' => 'productName',
            'label' => 'Product Name',
            'type' => 'text',
            'filter' => $this->getFilterObject()->getFilters($tableName, 'productName')['productName'],
        ]);
        $this->addColumns('createdDate', [
            'field' => 'createdDate',
            'label' => 'Created On',
            'type' => 'date',
            'filter' => $this->getFilterObject()->getFilters($tableName, 'createdDate')['createdDate'],
        ]);
        $this->addColumns('quantity', [
            'field' => 'quantity',
            'label' => 'Quantity',
            'type' => 'number',
            'filter' => $this->getFilterObject()->getFilters($tableName, 'quantity')['quantity'],
        ]);

        $this->addColumns('discount', [
            'field' => 'discount',
            'label' => 'Discount',
            'type' => 'number',
            'filter' => $this->getFilterObject()->getFilters($tableName, 'discount')['discount'],
        ]);
        $this->addColumns('price', [
            'field' => 'price',
            'label' => 'Base Price',
            'type' => 'number',
            'filter' => $this->getFilterObject()->getFilters($tableName, 'price')['price'],
        ]);
        $this->addColumns('changedPrice', [
            'field' => 'changedPrice',
            'label' => 'Price',
            'type' => 'number',
            'filter' => $this->getFilterObject()->getFilters($tableName, 'changedPrice')['changedPrice'],
        ]);
        $this->addColumns('totalPrice', [
            'field' => 'totalPrice',
            'label' => 'Total Price',
            'type' => 'number',
            'filter' => $this->getFilterObject()->getFilters($tableName, 'totalPrice')['totalPrice'],
        ]);


        return $this;
    }

    public function getTitle()
    {
        $this->getTitle = 'Manage Cart';
        return $this->getTitle;
    }

    // -----> Manage button actions ------

    public function prepareActions()
    {
        $this->addActions('delete', [
            'label' => '<i class="fas fa-trash-alt" style="color:tomato"></i>',
            'method' => 'getDeleteUrl',
            'ajax' => false
        ]);
        return $this;
    }

    public function getDeleteUrl($row)
    {
        return $this->getUrlObject()->getUrl('delete', null, ['id' => $row->cartItemId], true);
    }

    public function getUpdateCartUrl($row)
    {
        return $this->getUrlObject()->getUrl('save', null, ['id' => $row->cartId], true);
    }

    public function getCheckoutUrl($row)
    {
        return $this->getUrlObject()->getUrl('checkout', 'cart\Checkout', ['id' => $row->cartItemId], true);
    }

    public function getAddNewUrl($row)
    {
        return $this->getUrlObject()->getUrl('grid', 'product', null, true);
    }

    public function getCustomerList()
    {
        $customerList = \Mage::getModel('Model\Customer')->fetchAll()->getData();
        if (!$customerList) {
            $this->getMessage()->getFailure("Ooops !! no customer found...");
            return null;
        }
        return $customerList;
    }

    // -----> Manage buttons ------

    public function prepareButtons()
    {
        $this->addButtons('addnew', [
            'label' => '<i class="fas fa-plus"></i> Add New',
            'method' => 'getAddNewUrl',
            'ajax' => false,
        ]);
        $this->addButtons('updateCart', [
            'label' => '<i class="fas fa-cart-arrow-down"></i> Update Cart',
            'method' => 'getUpdateCartUrl',
            'ajax' => false,
        ]);
        $this->addButtons('applyFilter', [
            'label' => '<i class="fas fa-filter"></i> Apply Filter',
            'method' => 'getFilterAction',
            'ajax' => false,
        ]);
        $this->addButtons('checkout', [
            'label' => '<i class="fas fa-credit-card"></i> Proceed to checkout',
            'method' => 'getCheckoutUrl',
            'ajax' => false,
        ]);
        if ($this->getFilterObject()->getFilters($this->getTableName()) != null) {
            $this->addButtons('clearFilter', [
                'label' => '<i class="fas fa-times-circle"></i> Clear Filters',
                'method' => 'getClearFilterAction',
                'ajax' => false,
            ]);
            return $this;
        }
    }

    public function getActiveCustomerActionUrl()
    {
        return $this->getUrlObject()->getUrl('setActiveCustomerCart', 'cart', null, true);
    }

    public function getActiveCustomerId()
    {
        $activeCustomerId = \Mage::getModel('Model\Admin\Session')->activeCustomerId;
        if ($activeCustomerId) {
            return $activeCustomerId;
        }
        return null;
    }

    public function buildFilterQuery($tableName)
    {
        $filters = $this->getFilterObject()->getFilters();
        $query = "SELECT * FROM `{$tableName}`";
        if ($filters) {
            $query .= " WHERE ";
            foreach ($filters as $key => $value) {
                if ($value) {
                    $query .= "`" . $key . "` LIKE '%" . $value . "%' AND ";
                }
            }
        }
        $query = rtrim($query, ' AND ') . ";";
        return $query;
    }

    public function getProducts()
    {
        $cartItem = \Mage::getModel('Model\Cart')->getCart()->getItems();
        if ($cartItem) {
            foreach ($cartItem->getData() as $key => $value) {
                $product = \Mage::getModel('Model\Product')->load($value->productId)->getOriginalData();
                $this->products[$key] = $product;
            }
            return $this->products;
        }
        return null;
    }
}
