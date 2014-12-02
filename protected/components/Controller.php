<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
    public $cityIndex = "К";
    public $html = null;
    public $widgetClass = "";
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/column1';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();

    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules()
    {
        return array(
            array('allow',
                'controllers'=>array('site','api'),
                'actions'=>array('login','getsource','callorders'),
                'users'=>array('*'),
            ),
            array('allow',
                'controllers'=>array('users','site','orders','roles','source','hr','ajax','employee','ads','adscard','adsregion','adsbase','adsarch','advert'),
                'actions'=>array('admin','login','logout','index','create','createOrder','view','update','archiveOrder','delete','today','hrindex',
                'hrtoday','hrtables','deleteTable','hrmonth','settimestatus','day','employeelist','employeeprofile','employeeupdate','employeereport','adsmenu','adsregion','adsbase','adsreport','adsjournal','adsmaterials','adsact','adscards','adscardupdate','adscardcreate','adscardview',
                    'adscarddelete','regioncreate','regiondelete','regionupdate','regionlist','baselist','baseupdate','dailyreportlist','dailyreportcreate','dailyreportview','dailyreportupdate','adsarchlist','adstoarch','adsgetinfo','adsofarch','adsarchviews','todayreport','addchat','getchatorder',
                    'advertmenu','advertads','advertsite','advertpost','advertpostadd','advertpostlist',"advertpostdel"),
                'roles'=>array('1'),
            ),
            array('allow',
                'controllers'=>array('site','orders'),
                'actions'=>array('index','logout','view','update','todayreport'),
                'roles'=>array('4'),
            ),
            array('allow',
                'controllers'=>array('site','hr','ajax','employee','ads','adscard','adsregion','adsbase','adsarch'),
                'actions'=>array('index','logout','hrindex',
                    'hrtoday','hrtables','deleteTable','hrmonth','settimestatus','day','employeelist','employeeprofile','employeeupdate','employeereport','adsmenu','adsregion','adsbase','adsreport','adsjournal','adsmaterials','adsact','adscards','adscardupdate','adscardcreate','adscardview',
                    'adscarddelete','regioncreate','regiondelete','regionupdate','regionlist','baselist','baseupdate','dailyreportlist','dailyreportcreate','dailyreportview','dailyreportupdate','adsarchlist','adstoarch','adsgetinfo','adsofarch','adsarchviews','todayreport'),
                'roles'=>array('5'),
            ),
            array('allow',
                'controllers'=>array('site','orders','ajax'),
                'actions'=>array('login','logout','index','create','createOrder','view','update','archiveOrder','addchat','todayreport'),
                'roles'=>array('3'),
            ),
            array('allow',
                'controllers'=>array('Ajax'),
                'actions'=>array('gettech','getproblem'),
                'users'=>array('@'),
            ),
            array('deny',  // deny all users
                'users'=>array('*'),
            ),
        );
    }
}