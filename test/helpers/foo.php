<?php

namespace foo\bar\biz;

class User extends \ActiveRecord\Model {
	static $has_many = array(
		array('user_newsletters'),
		array('newsletters', 'through' => 'user_newsletters')
	);

}

class Newsletter extends \ActiveRecord\Model {
	static $has_many = array(
		array('user_newsletters'),
		array('users', 'through' => 'user_newsletters'),
	);
}

class UserNewsletter extends \ActiveRecord\Model {
	static $belong_to = array(
		array('user'),
		array('newsletter'),
	);
}

class Story extends \ActiveRecord\Model {
  static $has_many = [
		['read_receipts', 'class_name' => 'NewsReadReceipt'],
    ['users', 'through' => 'read_receipts']
  ];
}

class NewsReadReceipt extends \ActiveRecord\Model {
  static $belongs_to = [
    ['story'],
    ['user']
  ];
}
