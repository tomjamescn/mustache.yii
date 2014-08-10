<?php
/**
 * Implementation of the `CMustacheModelHelper` class.
 * @module CMustacheModelHelper
 */

/**
 * TODO /model attributes in views/ Component providing a collection of helper methods for creating views.
 * @class CMustacheModelHelper
 * @extends CComponent
 * @constructor
 * @param {CModel} $model The data model.
 */
class CMustacheModelHelper extends CComponent {

  public function __construct(CModel $model) {
    $this->model=$model;
  }

  /**
   * The underlying data model.
   * @property model
   * @type CModel
   * @private
   */
  private $model;

	/**
	 * Generates a check box for a model attribute.
	 * @property checkBox
	 * @type Closure
	 * @final
	 */
	public function getCheckBox() {
    return function($attribute, Mustache_LambdaHelper $helper) {
      return CHtml::activeCheckBox($this->model, $helper->render($attribute));
    };
	}

	/**
	 * Generates a date field input for a model attribute.
	 * @property dateField
	 * @type Closure
	 * @final
	 */
	public function getDateField() {
    return function($attribute, Mustache_LambdaHelper $helper) {
  		return CHtml::activeDateField($this->model, $helper->render($attribute));
    };
	}

	/**
	 * Generates an email field input for a model attribute.
	 * @property emailField
	 * @type Closure
	 * @final
	 */
	public function getEmailField() {
    return function($attribute, Mustache_LambdaHelper $helper) {
  		return CHtml::activeEmailField($this->model, $helper->render($attribute));
    };
	}

	/**
	 * Displays the first validation error for a model attribute.
	 * @property error
	 * @type Closure
	 * @final
	 */
  public function getError() {
    return function($attribute, Mustache_LambdaHelper $helper) {
  		return CHtml::error($this->model, $helper->render($attribute));
    };
  }

	/**
	 * Displays a summary of validation errors for the model.
	 * @property errorSummary
	 * @type string
	 * @final
	 */
  public function getErrorSummary() {
    return CHtml::errorSummary($this->model);
  }

	/**
	 * Generates a file input for a model attribute.
	 * @property fileField
	 * @type Closure
	 * @final
	 */
	public function getFileField() {
    return function($attribute, Mustache_LambdaHelper $helper) {
  		return CHtml::activeFileField($this->model, $helper->render($attribute));
    };
	}

  /**
	 * Generates a hidden input for a model attribute.
	 * @property hiddenField
	 * @type Closure
	 * @final
	 */
	public function getHiddenField() {
    return function($attribute, Mustache_LambdaHelper $helper) {
  		return CHtml::activeHiddenField($this->model, $helper->render($attribute));
    };
	}

	/**
	 * Generates input field ID for a model attribute.
	 * @property id
	 * @type Closure
	 * @final
	 */
	public function getId() {
    return function($attribute, Mustache_LambdaHelper $helper) {
      return CHtml::activeId($this->model, $helper->render($attribute));
    };
  }

	/**
	 * Generates a label tag for a model attribute.
	 * @property label
	 * @type Closure
	 * @final
	 */
	public function getLabel() {
    return function($attribute, Mustache_LambdaHelper $helper) {
      return CHtml::activeLabelEx($this->model, $helper->render($attribute));
    };
  }

	/**
	 * Generates HTML name for the model.
	 * @property modelName
	 * @type string
	 * @final
	 */
  public function getModelName() {
    return CHtml::modelName($this->model);
  }

	/**
	 * Generates input field name for a model attribute.
	 * @property name
	 * @type Closure
	 * @final
	 */
	public function getName() {
    return function($attribute, Mustache_LambdaHelper $helper) {
  		return CHtml::activeName($this->model, $helper->render($attribute));
    };
	}

	/**
	 * Generates a number field input for a model attribute.
	 * @property numberField
	 * @type Closure
	 * @final
	 */
	public function getNumberField() {
    return function($attribute, Mustache_LambdaHelper $helper) {
  		return CHtml::activeNumberField($this->model, $helper->render($attribute));
    };
	}

	/**
	 * Generates a password field input for a model attribute.
	 * @property passwordField
	 * @type Closure
	 * @final
	 */
	public function getPasswordField() {
    return function($attribute, Mustache_LambdaHelper $helper) {
  		return CHtml::activePasswordField($this->model, $helper->render($attribute));
    };
	}

	/**
	 * Generates a radio button for a model attribute.
	 * @property radioButton
	 * @type Closure
	 * @final
	 */
	public function getRadioButton() {
    return function($attribute, Mustache_LambdaHelper $helper) {
  		return CHtml::activeRadioButton($this->model, $helper->render($attribute));
    };
	}

	/**
	 * Generates a range field input for a model attribute.
	 * @property rangeField
	 * @type Closure
	 * @final
	 */
	public function getRangeField() {
    return function($attribute, Mustache_LambdaHelper $helper) {
  		return CHtml::activeRangeField($this->model, $helper->render($attribute));
    };
	}

	/**
	 * Generates a search field input for a model attribute.
	 * @property searchField
	 * @type Closure
	 * @final
	 */
	public function getSearchField() {
    return function($attribute, Mustache_LambdaHelper $helper) {
  		return CHtml::activeSearchField($this->model, $helper->render($attribute));
    };
	}

	/**
	 * Generates a telephone field input for a model attribute.
	 * @property telField
	 * @type Closure
	 * @final
	 */
	public function getTelField() {
    return function($attribute, Mustache_LambdaHelper $helper) {
  		return CHtml::activeTelField($this->model, $helper->render($attribute));
    };
	}

	/**
	 * Generates a text area input for a model attribute.
	 * @property textArea
	 * @type Closure
	 * @final
	 */
	public function getTextArea() {
    return function($attribute, Mustache_LambdaHelper $helper) {
  		return CHtml::activeTextArea($this->model, $helper->render($attribute));
    };
	}

	/**
	 * Generates a text field input for a model attribute.
	 * @property textField
	 * @type Closure
	 * @final
	 */
	public function getTextField() {
    return function($attribute, Mustache_LambdaHelper $helper) {
  		return CHtml::activeTextField($this->model, $helper->render($attribute));
    };
	}

	/**
	 * Generates a time field input for a model attribute.
	 * @property timeField
	 * @type Closure
	 * @final
	 */
	public function getTimeField() {
    return function($attribute, Mustache_LambdaHelper $helper) {
  		return CHtml::activeTimeField($this->model, $helper->render($attribute));
    };
	}

	/**
	 * Generates a url field input for a model attribute.
	 * @property urlField
	 * @type Closure
	 * @final
	 */
	public function getUrlField() {
    return function($attribute, Mustache_LambdaHelper $helper) {
  		return CHtml::activeUrlField($this->model, $helper->render($attribute));
    };
	}

	/**
	 * Evaluates the value of a model attribute.
	 * @property value
	 * @type Closure
	 * @final
	 */
  public function getValue() {
    return function($attribute, Mustache_LambdaHelper $helper) {
  		return CHtml::value($this->model, $helper->render($attribute));
    };
  }
}
