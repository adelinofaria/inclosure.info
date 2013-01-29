<?
class Input {
    protected $field_id   = '';       		# Used for both input name and id
    protected $field_label      = '';       # Field label
    protected $field_value       = '';      # Default value
	  protected $field_class       = '';      # Default Class
    protected $field_options    = array();  # Arrays of options (value => display_text) for selects and multiple checkboxes etc.
    protected $field_help       = '';       # Optional note
    protected $field_required        = '';  # Required - true or false
    protected $field_onblur     = '';       # OnBlur event - usually used for validation
    protected $field_onkeyup    = '';       # OnKeyUp event - usually used for validation
    protected $field_other      = array();  # Any other settings
    protected $field_html       = '';       # The HTML to print
    protected static $is_extended = 0; 		# Will be changed to 1 if child class used
    /*
    **  __construct()
    **  Constructor - used to create new input instance. All settings for the
    **  input must be passed in when a new Input instance is created.
    **
    **  @param   string       Field ID and name
    **  @param   string       Field label
    **  @param   str|int      Default value
    **  @param   string       Optional note to appear underneath field
    **  @param   array        Any other settings can be stored in this array
    **  @return  string       HTML - can be printed using echoInput();
    */
    public function __construct(
	  $field_type,
      $field_id,
      $field_label = '',
      $field_value = '',
	  $field_class = '',
      $field_options = '',
      $field_help = '',
      $field_required = FALSE,
      $field_onblur = '',
      $field_onkeyup = '',
      $field_other = array()
      ) {
      # Set main member variables
	  $this->field_type   		= $field_type;  	# Field type
      $this->field_id   		= $field_id;  		# Used for both input name and id
      $this->field_label      	= $field_label;     # Field label
      $this->field_value       	= $field_value;     # Default value, string or integer
	  $this->field_class       	= $field_class;     # Default class, string
      $this->field_options    	= $field_options;   # Array of select options
      $this->field_help       	= $field_help;      # Optional note
      $this->field_required     = $field_required;  # Required - true or false
      $this->field_onblur     	= $field_onblur;    # OnBlur event - usually used for validation
      $this->field_onkeyup    	= $field_onkeyup;   # OnKeyUp event - usually used for validation
      $this->field_other      	= $field_other;     # Any other settings
	  if ($this->field_type == 'text') {
        $this->field_html = $this->compileTextBox();
      }
	  
	  elseif ($this->field_type == 'textarea') {
        $this->field_html = $this->compileTextArea();
      }
	  
	  elseif ($this->field_type == 'password') {
        $this->field_html = $this->compilePasswordBox();
      }
	  
	  elseif ($this->field_type == 'select') {
        $this->field_html = $this->compileSelectBox();
      }
	  
	  elseif ($this->field_type == 'selectNewOption') {
        $this->field_html = $this->compileSelectBoxNewOption();
      }
	  elseif ($this->field_type == 'selectCategory') {
        $this->field_html = $this->compileSelectBoxCategory();
      }
	  
	  elseif ($this->field_type == 'radio') {
        $this->field_html = $this->compileRadios();
      }
	  
	  elseif ($this->field_type == 'checkbox') {
        $this->field_html = $this->compileCheckBox();
      }
	  
	  elseif ($this->field_type == 'multicheckbox') {
        $this->field_html = $this->compileMultiCheckboxes();
      }
	  
	  elseif ($this->field_type == 'img') {
        $this->field_html = $this->compileImageUpload();
      }
	  
	  elseif ($this->field_type == 'file') {
        $this->field_html = $this->compileFileUpload();
      }
	  
	  elseif ($this->field_type == 'tags') {
        $this->field_html = $this->compileTagSelector();
      }
	  
	  elseif ($this->field_type == 'date') {
        $this->field_html = $this->compileDateTimeSelector();
      }
	  
	  elseif ($this->field_type == 'code') {
        $this->field_html = $this->compileCodeInput();
      }
	  
	  elseif ($this->field_type == 'hidden') {
        $this->field_html = $this->compileHiddenField();
      }
      else {
        # Only trigger error if we're NOT using a child class to extend this one
        # (if we are, this is handled by child class at end of its constructor):
        if (self::$is_extended == 0) { trigger_error('Unable to determine field type'); }
      }
	  
    }
	
	/*
    **  echoInput()
    **  Prints the compiled input element.
    **
    **  @return  echoes directly
    */
    public function echoInput() {
      if (empty($this->field_html)) {
        trigger_error('Could not print input - it does not exist.');
      }
      echo $this->field_html;
    }
	
	/*
    **  getInput()
    **  Returns input HTML, rather than print it direcly which echoInput() does.
    **
    **  @return  string
    */
    public function getInput() {
      if (empty($this->field_html)) {
        trigger_error('Could not return input HTML - it does not exist.');
      }
      return $this->field_html;
    }
	
	protected function compileTextBox() {
      /*
        WEBMASTER NOTES:
        ****************
        Ouputted HTML looks like this:
        <div class="controlset">
          <span class="label">Label <em>*</em></span>
          <input id="field_name" name="field_name" type="text" value="Default value" onblur="optional" onkeyup="optional" title="Optional note and validation errors" />
          <p id="field_name_note" class="note"></p>
        </div>
      */
      $ts_html = '';
      $ts_html .= '<div class="controlset">';
      $ts_html .= '<span class="label">';
      if (trim($this->field_label) != '') {
        $ts_html .=  $this->field_label;
      }
      if ($this->field_required == TRUE) {
        $ts_html .= '<em>*</em>';
      }
      $ts_html .= '</span>';
      $ts_html .= '<input id="' . $this->field_id . '" name="' . $this->field_id . '" type="text" value="' . htmlspecialchars($this->field_value) . '" ';
	  if (!empty($this->field_class)) {
        $ts_html .= 'class="' . $this->field_class . '" ';
      }
      if (trim($this->field_onblur) != '') {
        $ts_html .= 'onblur="' . $this->field_onblur . '" ';
      }
      if (trim($this->field_onkeyup) != '') {
        $ts_html .= 'onkeyup="' . $this->field_onkeyup . '" ';
      }
	  if (trim($this->field_help) != '') {
        $ts_html .= 'title="' . $this->field_help . '" ';
      }
	  if (!empty($this->field_other['readonly'])) {
        $ts_html .= 'readonly="' .  $this->field_other['readonly'] . '" ';
      }
	  if (!empty($this->field_other['disabled'])) {
        $ts_html .= 'disabled="' .  $this->field_other['disabled'] . '" ';
      }
	  if (!empty($this->field_other['style'])) {
        $ts_html .= 'style="' .  $this->field_other['style'] . '" ';
      }
      $ts_html .= '/>';
	  if (!empty($this->field_other['note'])) {
	  $ts_html .= '<p class="note">' . $this->field_other['note'] . '</p>';
	  }
      $ts_html .= '<p id="' . $this->field_id . '_note" class="note">' . '' . '</p>';
      $ts_html .= '</div>';
      $ts_html .= '<div class="c"></div>';
      return $ts_html;
    }
	
	/*
    **  compileTextArea()
    **  Creates HTML for a textarea
    **
    **  @param   string  Optional class for <textarea>, used by compileWYSIWYG in CMSInput, for instance
    **  @return  string  HTML
    */
    protected function compileTextArea() {
      /*
        WEBMASTER NOTES:
        ****************
        Ouputted HTML looks like this:
        <div class="controlset">
          <span class="label">Label <em>*</em></span>
          <textarea id="field_name" name="field_name" rows="5" cols="50" onblur="optional" onkeyup="optional">Default value</textarea>
          <p id="field_name_note" class="note">Optional note and validation errors</p>
        </div>
      */
      # Set default rows
	  if (!empty($this->field_class) and strstr($this->field_class, "tinymce")) { $time = md5(time())."_"; } else { $time = "";}
      if (!isset($this->field_other['rows'])) {
        $this->field_other['rows'] = 3;
      }
      # Set default cols
      if (!isset($this->field_other['cols'])) {
        $this->field_other['cols'] = 25;
      }
      $ts_html = '';
      $ts_html .= '<div class="controlset">';
      $ts_html .= '<span class="label" style="width:50%;">';
      if (trim($this->field_label) != '') {
        $ts_html .=  $this->field_label;
      }
      if ($this->field_required == TRUE) {
        $ts_html .= '<em>*</em>';
      }
      $ts_html .= '</span>';
	  if (strstr($this->field_class, "tinymce")) {
        $ts_html .= '<span style="float:right; width:40%; text-align:right; margin:0 4% 0 0;"><a href="javascript:$(\'#'.$time .$this->field_id.'\').tinymce(\''.'toggle'.'\');" >[Mostrar/esconder editor]</a></span>';
      }
      $ts_html .= '<textarea id="' . $time . $this->field_id . '" name="' . $this->field_id . '" ';
      if (!empty($this->field_class) and !strstr($this->field_class, "tinymce")) {
        $ts_html .= 'class="' . $this->field_class . ' wp-count-textarea " ';
      }
	  else if (!empty($this->field_class) and strstr($this->field_class, "tinymce")) {
        $ts_html .= 'class="' . $this->field_class . ' " ';
      }
	  else
	  {
		 $ts_html .= 'class="wp-count-textarea " '; 
	  }
      $ts_html .= 'rows="' . $this->field_other['rows'] . '" cols="' . $this->field_other['cols'] . '" ';
      if (trim($this->field_onblur) != '') {
        $ts_html .= 'onblur="' . $this->field_onblur . '" ';
      }
      if (trim($this->field_onkeyup) != '') {
        $ts_html .= 'onkeyup="' . $this->field_onkeyup . '" ';
      }
	  if (trim($this->field_help) != '') {
        $ts_html .= 'title="' . $this->field_help . '" ';
      }
      $ts_html .= '>';
      $ts_html .= htmlspecialchars($this->field_value);
      $ts_html .= '</textarea>';
	  if (strstr($this->field_class, "wordcount")) {
	  $ts_html .= '<p id="wp-word-count" class="note">' . ' ' . '</p>';
	  }
	  if (!empty($this->field_other['note'])) {
	  $ts_html .= '<p class="note">' . $this->field_other['note'] . '</p>';
	  }
      $ts_html .= '<p id="' . $time .$this->field_id . '_note" class="note">' . '' . '</p>';
      $ts_html .= '</div>';
	  
      $ts_html .= '<div class="c"></div>';
	
      return $ts_html;
    }
	
	
	 /*
    **  compilePasswordBox()
    **  Creates HTML for a password input box
    **
    **  @return  string  HTML
    */
    protected function compilePasswordBox() {
      /*
        WEBMASTER NOTES:
        ****************
        Ouputted HTML looks like this:
        <div class="controlset">
          <span class="label">Label <em>*</em></span>
          <input id="field_name" name="field_name" type="password" value="defaultvalue" onblur="optional" onkeyup="optional" />
          <p id="field_name_note" class="note">Optional note and validation errors</p>
        </div>
      */
      $ts_html = '';
      $ts_html .= '<div class="controlset">';
      $ts_html .= '<span class="label">';
      if (trim($this->field_label) != '') {
        $ts_html .=  $this->field_label;
      }
      if ($this->field_required == TRUE) {
        $ts_html .= '<em>*</em>';
      }
      $ts_html .= '</span>';
      $ts_html .= '<input id="' . $this->field_id . '" name="' . $this->field_id . '" type="password" value="' . $this->field_value . '" ';
	  if (trim($this->field_help) != '') {
        $ts_html .= 'title="' . $this->field_help . '" ';
      }
	  if (!empty($this->field_class)) {
        $ts_html .= 'class="' . $this->field_class . '" ';
      }
      if (trim($this->field_onblur) != '') {
        $ts_html .= 'onblur="' . $this->field_onblur . '" ';
      }
      if (trim($this->field_onkeyup) != '') {
        $ts_html .= 'onkeyup="' . $this->field_onkeyup . '" ';
      }
      $ts_html .= '/>';
	  if(strstr($this->field_class,"doCheck")){
	  $ts_html .= '<div class="checkerPassword"></div>';
	  }
	  if (!empty($this->field_other['note'])) {
	  $ts_html .= '<p class="note">' . $this->field_other['note'] . '</p>';
	  }
      $ts_html .= '<p id="' . $this->field_id . '_note" class="note">' . '' . '</p>';
      $ts_html .= '</div>';
      $ts_html .= '<div class="c"></div>';
      return $ts_html;
    }
	
	
	/*
    **  compileSelectBox()
    **  Creates HTML for a <select> drop-down box
    **
    **  @return  string  HTML
    */
    protected function compileSelectBox() {
      /*
        WEBMASTER NOTES:
        ****************
        Ouputted HTML looks like this:
        <div class="controlset">
          <span class="label">Label <em>*</em></span>
          <select id="field_name" name="field_name" onblur="optional" onkeyup="optional">
            <option value="1"></option>
            <option selected="selected" value="2"></option>
            <option value="3"></option>
          </select>
          <p id="field_name_note" class="note">Optional note and validation errors</p>
        </div>
      */
      $ts_html = '';
      $ts_html .= '<div class="controlset">';
      $ts_html .= '<span class="label">';
      if (trim($this->field_label) != '') {
        $ts_html .=  $this->field_label;
      }
      if ($this->field_required == TRUE) {
        $ts_html .= '<em>*</em>';
      }
      $ts_html .= '</span>';
      $ts_html .= '<select id="' . $this->field_id . '" name="' . $this->field_id . '" ';
	  if (trim($this->field_help) != '') {
        $ts_html .= 'title="' . $this->field_help . '" ';
      }
	  if (!empty($this->field_class)) {
        $ts_html .= 'class="' . $this->field_class . '" ';
      }
      if (trim($this->field_onblur) != '') {
        $ts_html .= 'onblur="' . $this->field_onblur . '" ';
      }
      if (trim($this->field_onkeyup) != '') {
        $ts_html .= 'onkeyup="' . $this->field_onkeyup . '" ';
      }
      if (!empty($this->field_other['onChange'])) {
        $ts_html .= 'onchange="' .  $this->field_other['onChange'] . '" ';
      }
      $ts_html .= '>';
      foreach ($this->field_options as $key => $value) {
        $ts_html .= '<option ';
        if ($this->field_value == $key) {
          $ts_html .= 'selected="selected" ';
        }
        $ts_html .= 'value="' . $key . '">' . $value . '</option>';
      }
      $ts_html .= '</select>';
	  if (!empty($this->field_other['note'])) {
	  $ts_html .= '<p class="note">' . $this->field_other['note'] . '</p>';
	  }
      $ts_html .= '<p id="' . $this->field_id . '_note" class="note">' . '' . '</p>';
      $ts_html .= '</div>';
      $ts_html .= '<div class="c"></div>';
      return $ts_html;
    }
	
	/*
    **  compileSelectBoxClients()
    **  Creates HTML for a <select> drop-down box
    **
    **  @return  string  HTML
    */
    protected function compileSelectBoxNewOption() {
      $ts_html = '';
      $ts_html .= '<div class="controlset">';
      $ts_html .= '<span class="label">';
      if (trim($this->field_label) != '') {
        $ts_html .=  $this->field_label;
      }
      if ($this->field_required == TRUE) {
        $ts_html .= '<em>*</em>';
      }
      $ts_html .= '</span>';
      $ts_html .= '<select id="' . $this->field_id . '" name="' . $this->field_id . '" ';
	  if (trim($this->field_help) != '') {
        $ts_html .= 'title="' . $this->field_help . '" ';
      }
	  if (!empty($this->field_class)) {
        $ts_html .= 'class="' . $this->field_class . '" ';
      }
      if (trim($this->field_onblur) != '') {
        $ts_html .= 'onblur="' . $this->field_onblur . '" ';
      }
      if (trim($this->field_onkeyup) != '') {
        $ts_html .= 'onkeyup="' . $this->field_onkeyup . '" ';
      }
      if (!empty($this->field_other['onChange'])) {
        $ts_html .= 'onchange="' .  $this->field_other['onChange'] . '" ';
      }
      $ts_html .= '>';
      foreach ($this->field_options as $key => $value) {
        $ts_html .= '<option ';
        if ($this->field_value == $key) {
          $ts_html .= 'selected="selected" ';
        }
        $ts_html .= 'value="' . $key . '">' . $value . '</option>';
      }
	  $ts_html .= '<option value="-1" disabled="disabled" >' . "----------------------" . '</option>';
	  $ts_html .= '<option value="0">' . "Novo Registo" . '</option>';
      $ts_html .= '</select>';
	  if (!empty($this->field_other['note'])) {
	  $ts_html .= '<p class="note">' . $this->field_other['note'] . '</p>';
	  }
      $ts_html .= '<p id="' . $this->field_id . '_note" class="note">' . '' . '</p>';
      $ts_html .= '</div>';
      $ts_html .= '<div class="c"></div>';
      return $ts_html;
    }
	
	/*
    **  compileSelectBoxCategory()
    **  Creates HTML for a <select> drop-down box
    **
    **  @return  string  HTML
    */
    protected function compileSelectBoxCategory() {
      $ts_html = '';
      $ts_html .= '<div class="controlset">';
      $ts_html .= '<span class="label">';
      if (trim($this->field_label) != '') {
        $ts_html .=  $this->field_label;
      }
      if ($this->field_required == TRUE) {
        $ts_html .= '<em>*</em>';
      }
      $ts_html .= '</span>';
      $ts_html .= '<select id="' . $this->field_id . '" name="' . $this->field_id . '" ';
	  if (trim($this->field_help) != '') {
        $ts_html .= 'title="' . $this->field_help . '" ';
      }
	  if (!empty($this->field_class)) {
        $ts_html .= 'class="' . $this->field_class . '" ';
      }
      if (trim($this->field_onblur) != '') {
        $ts_html .= 'onblur="' . $this->field_onblur . '" ';
      }
      if (trim($this->field_onkeyup) != '') {
        $ts_html .= 'onkeyup="' . $this->field_onkeyup . '" ';
      }
      if (!empty($this->field_other['onChange'])) {
        $ts_html .= 'onchange="' .  $this->field_other['onChange'] . '" ';
      }
      $ts_html .= '>';
      foreach ($this->field_options as $key => $value) {
        $ts_html .= '<option ';
        if ($this->field_value == $key) {
          $ts_html .= 'selected="selected" ';
        }
        $ts_html .= 'value="' . $key . '">' . $value . '</option>';
      }
	  $ts_html .= '<option value="-1" disabled="disabled">' . "----------------------" . '</option>';
	  $ts_html .= '<option value="0">' . "Nova Categoria" . '</option>';
      $ts_html .= '</select>';
	  $ts_html .= '<p >' . 'Para editar traduções das categorias aceda à <a href="/admin/categories/list" rel="external" title="Abrir em novo separador">Página das Categorias</a>' . '</p>';
      $ts_html .= '<p id="' . $this->field_id . '_note" class="note">' . '' . '</p>';
      $ts_html .= '</div>';
      $ts_html .= '<div class="c"></div>';
      return $ts_html;
    }
	 /*
    **  compileRadios()
    **  Creates HTML for a linked series of radio buttons
    **
    **  @return  string  HTML
    */
    protected function compileRadios() {
      /*
        WEBMASTER NOTES:
        ****************
        <div class="controlset">
          <span class="label">Label <em>*</em></span>
          <div class="inputs-block">
            <div class="inputs-row"><input type="radio" name="field_name" id="field_name_1" value="1" /><label for="field_name_1">Option 1</label></div>
            <div class="inputs-row"><input type="radio" name="field_name" id="field_name_2" value="2" /><label for="field_name_2">Option 2</label></div>
            <div class="inputs-row"><input type="radio" name="field_name" id="field_name_3" value="3" /><label for="field_name_3">Option 3</label></div>
          </div>
          <p id="field_name_note" class="note">Optional note and validation errors</p>
        </div>
      */
      # If current value is not set (e.g. in case of adding a new record) then set
      # data to first key in the array so this is selected by default:
      if ($this->field_value == '') {
        $ta_keys = array_keys($this->field_options);
        $this->field_value = array_shift($ta_keys);
      }
      $ts_html = '';
      $ts_html .= '<div class="controlset">';
      $ts_html .= '<span class="label">';
      if (trim($this->field_label) != '') {
        $ts_html .=  $this->field_label;
      }
      if ($this->field_required == TRUE) {
        $ts_html .= '<em>*</em>';
      }
      $ts_html .= '</span>';
      $i=1;
      $ts_html .= '<div class="inputs-block">';
      foreach ($this->field_options as $key => $value) {
        $ts_html .= '<div class="inputs-row">';
        $ts_html .= '<input ';
        if ($this->field_value == $key) {
          $ts_html .= 'checked="checked" ';
        }
        $ts_html .= 'type="radio" id="' . $this->field_id . '_' . $i . '" class="radio" name="' . $this->field_id . '" ';
        $ts_html .= 'value="' . $key . '" ';
        if (!empty($this->field_other['onClick'])) {
          $ts_html .= 'onclick="' .  $this->field_other['onClick'] . '" ';
        }
		if (trim($this->field_help) != '') {
		  $ts_html .= 'title="' . $this->field_help . '" ';
		}
		if (!empty($this->field_class)) {
		  $ts_html .= 'class="' . $this->field_class . '" ';
		}
        $ts_html .= ' />';
        $ts_html .= '<label for="' . $this->field_id . '_' . $i . '">&nbsp;&nbsp;' . $value . '</label>';
        $ts_html .= '</div>';
        $i++;
      }
      $ts_html .= '</div>';
	  if (!empty($this->field_other['note'])) {
	  $ts_html .= '<p class="note">' . $this->field_other['note'] . '</p>';
	  }
      $ts_html .= '<p id="' . $this->field_id . '_note" class="note">' . '' . '</p>';
      $ts_html .= '</div>';
      $ts_html .= '<div class="c"></div>';
      return $ts_html;
    }
	
	
	/*
    **  compileCheckBox()
    **  Creates HTML for a single checkbox
    **
    **  @return  string  HTML
    */
    protected function compileCheckBox() {
      /*
        WEBMASTER NOTES:
        ****************
        <input id="field_name" name="field_name" type="hidden" value="0" />
        <div class="controlset">
          <span class="label">Label <em>*</em></span>
          <div class="inputs-block">
            <input type="checkbox" name="field_name[]" id="field_name_1" value="1" /> <label for="field_name_1">Approved</label>
          </div>
          <p id="field_name_note" class="note">Optional note and validation errors</p>
        </div>
      */
      $ts_html = '';
      # Hidden blank text field, to make sure that something is returned:
      //$ts_html .= '<input id="' . $this->field_id . '" name="' . $this->field_id . '" type="hidden" value="0" />';
      $ts_html .= '<div class="controlset checkboxContainer">';
      $ts_html .= '<span class="label">';
	  if (trim($this->field_label) != '') {
        $ts_html .=  $this->field_label;
      }
      if ($this->field_required == TRUE) {
        $ts_html .= '<em>*</em>';
      }
      $ts_html .= '</span>';
      if (!is_array($this->field_options)) {
        trigger_error('Cannot print input field for ' . $this->field_id .', \'options\' is not an array.');
      }
      foreach ($this->field_options as $key => $value) {
        $ts_html .= '<div class="inputs-block">';
		 $ts_html .= '<label for="' . $this->field_id . '">' . $value . '</label>';
        $ts_html .= '<input ';
        if (in_array($key, explode(',', $this->field_value))) {
          $ts_html .= 'checked="checked" ';
        }
        $ts_html .= 'type="checkbox" id="' . $this->field_id .'" class="checkbox '.(!empty($this->field_class) ? $this->field_class : "").' " name="' . $this->field_id . '" ';
        if (!empty($this->field_other['onClick'])) {
          $ts_html .= 'onclick="' .  $this->field_other['onClick'] . '" ';
        }
		if (!empty($this->field_other['onChange'])) {
          $ts_html .= 'onchange="' .  $this->field_other['onChange'] . '" ';
        }
		if (trim($this->field_help) != '') {
		  $ts_html .= 'title="' . $this->field_help . '" ';
		}
		/*if (!empty($this->field_class)) {
		  $ts_html .= 'class="' . $this->field_class . '" ';
		}*/
        $ts_html .= 'value="' . $key . '" />';
       
        $ts_html .= '</div>';
        continue;
      }
	  if (!empty($this->field_other['note'])) {
	  $ts_html .= '<p class="note">' . $this->field_other['note'] . '</p>';
	  }
      $ts_html .= '<p id="' . $this->field_id . '_note" class="note">' . '' . '</p>';
      $ts_html .= '</div>';
      $ts_html .= '<div class="c"></div>';
      return $ts_html;
    }
	
	/*
    **  compileMultiSelect()
    **  Creates HTML for a multiple-select input using checkboxes
    **
    **  @return  string  HTML
    */
    protected function compileMultiCheckboxes() {
      /*
        WEBMASTER NOTES:
        ****************
        <input id="field_name" name="field_name" type="hidden" value="0" />
        <div class="controlset">
          <span class="label">Label <em>*</em></span>
          <div class="inputs-block">
            <div class="inputs-row"><input type="checkbox" name="field_name[]" id="field_name_1" value="1" /><label for="field_name_1">Option 1</label></div>
            <div class="inputs-row"><input type="checkbox" name="field_name[]" id="field_name_2" value="2" /><label for="field_name_2">Option 2</label></div>
            <div class="inputs-row"><input type="checkbox" name="field_name[]" id="field_name_3" value="3" /><label for="field_name_3">Option 3</label></div>
          </div>
          <p id="field_name_note" class="note">Optional note and validation errors</p>
        </div>
      */
      $ts_html = '';
      # Hidden blank text field, to make sure that something is returned:
      $ts_html .= '<div class="hide"><input id="' . $this->field_id . '" name="' . $this->field_id . '" type="hidden" value="0" /></div>';
      $ts_html .= '<div class="controlset">';
      $ts_html .= '<span class="label">';
      if (trim($this->field_label) != '') {
        $ts_html .=  $this->field_label;
      }
      if ($this->field_required == TRUE) {
        $ts_html .= '<em>*</em>';
      }
      $ts_html .= '</span>';
      $i=1;
      $ts_html .= '<div class="inputs-block">';
      foreach ($this->field_options as $key => $value) {
        $ts_html .= '<div class="inputs-row">';
        $ts_html .= '<input ';
        if (in_array($key, explode(',', $this->field_value))) {
          $ts_html .= 'checked="checked" ';
        }
		if (trim($this->field_help) != '') {
		  $ts_html .= 'title="' . $this->field_help . '" ';
		}
		/*if (!empty($this->field_class)) {
		  $ts_html .= 'class="' . $this->field_class . '" ';
		}*/
        $ts_html .= 'type="checkbox" id="' . $this->field_id . '_' . $i . '" class="checkbox '.(!empty($this->field_class) ? $this->field_class : "").' " name="' . $this->field_id . '[]" ';
        $ts_html .= 'value="' . $key . '" />';
        $ts_html .= '<label for="' . $this->field_id . '_' . $i . '">';
        $ts_html .= '&nbsp;&nbsp;' . $value . '</label>';
        $ts_html .= '</div>';
        $i++;
      }
      $ts_html .= '</div>';
      $ts_html .= '<p id="' . $this->field_id . '_note" class="note">' . '' . '</p>';
      $ts_html .= '</div>';
      $ts_html .= '<div class="c"></div>';
      return $ts_html;
    }
	
	
	/*
    **  compileImageUpload()
    **  Creates HTML to provide inputs through which user can upload images
    **
    **  @return  string  HTML
    */
	protected function compileImageUpload() {
      /*
        WEBMASTER NOTES:
        ****************
        Example output:
        <input type="hidden" name="MAX_FILE_SIZE" value="8000000" />
        <div class="controlset">
          <span class="label">Upload <em>*</em></span>
          <div class="inputs-block">
            <div class="inputs-row"><input type="file" id="FILE" name="FILE" /></div>
            <div class="inputs-row">Caption <input type="text" id="text_AltText" name="text_AltText" value="" /></div>
            <div class="inputs-row">&copy; <input type="text" id="text_AltText" name="text_AltText" value="" /></div>
          </div>
          <p id="field_name_note" class="note">Optional note and validation errors</p>
        </div>
      */
      $ts_html = '';
      $ts_html .= '<div class="hide"><input type="hidden" name="MAX_FILE_SIZE" value="8000000" /></div>'; # 8 megabytes
      $ts_html .= '<div class="controlset">';
      $ts_html .= '<span class="label">';
      if (trim($this->field_label) != '') {
        $ts_html .=  $this->field_label;
      }
      if ($this->field_required == TRUE) {
        $ts_html .= '<em>*</em>';
      }
      $ts_html .= '</span>';
      $ts_html .= '<div class="inputs-block">';
      $ts_html .= '<div class="inputs-row">';
      $ts_html .= '<input type="file" id="' . $this->field_id . '" name="' . $this->field_id . '" />';
      $ts_html .= '<p id="' . $this->field_id . '_note" class="note">Images must be JPEG, PNG or GIF</p>';
      $ts_html .= '</div>';
      $ts_html .= '</div>';
      $ts_html .= '</div>';
      $ts_html .= '<div class="controlset">';
      $ts_html .= '<span class="label">Caption</span>';
      $ts_html .= '<div class="inputs-block">';
      $ts_html .= '<div class="inputs-row"><input type="text" id="text_AltText" name="text_AltText" value="" /></div>';
      $ts_html .= '<p id="text_AltText_note" class="note">This will also be used for the image\'s \'alt text\' value and may also appear directly on web pages underneath the image</p>';
      $ts_html .= '</div>';
      $ts_html .= '</div>';
      $ts_html .= '<div class="controlset">';
      $ts_html .= '<span class="label">Copyright</span>';
      $ts_html .= '<div class="inputs-block">';
      $ts_html .= '<div class="inputs-row"><input type="text" id="text_Copyright" name="text_Copyright" value="" /></div>';
      $ts_html .= '<p id="text_Copyright_note" class="note">Optional</p>';
      $ts_html .= '</div>';
      $ts_html .= '</div>';
      $ts_html .= '<div class="c"></div>';
      return $ts_html;
    }
	
	
	/*
    **  compileFileUpload()
    **  Creates HTML to provide inputs through which user can upload files
    **
    **  @return  string  HTML
    */
    protected function compileFileUpload() {
      /*
        WEBMASTER NOTES:
        ****************
        Example output:
        <input type="hidden" name="MAX_FILE_SIZE" value="8000000" />
        <div class="controlset">
          <span class="label">Upload <em>*</em></span>
          <div class="inputs-block">
            <div class="inputs-row"><input type="file" id="FILE" name="FILE" /></div>
            <div class="inputs-row"><input type="text" id="text_FriendlyName" name="text_FriendlyName" value="" /></div>
          </div>
          <p id="field_name_note" class="note">Optional note and validation errors</p>
        </div>
      */
      $ts_html = '';
      $ts_html .= '<input type="hidden" name="MAX_FILE_SIZE" value="8000000" />'; # 8 megabytes
      $ts_html .= '<div class="controlset">';
      $ts_html .= '<span class="label">';
      if (trim($this->field_label) != '') {
        $ts_html .=  $this->field_label;
      }
      if ($this->field_required == TRUE) {
        $ts_html .= '<em>*</em>';
      }
      $ts_html .= '</span>';
      $ts_html .= '<div class="inputs-block">';
      $ts_html .= '<div class="inputs-row"><input type="file" id="' . $this->field_id . '" name="' . $this->field_id . '" /></div>';
     // $ts_html .= '<div class="inputs-row"><input type="text" id="text_FriendlyName" name="text_FriendlyName" value="" /></div>';
      $ts_html .= '<p id="' . $this->field_id . '_note" class="note">' . $this->field_help . '</p>';
      $ts_html .= '</div>';
      $ts_html .= '</div>';
      $ts_html .= '<div class="c"></div>';
      return $ts_html;
    }
	
	 /*
    **  compileHiddenField()
    **  Creates HTML for a hidden input field
    **
    **  @return  string  HTML
    */
    protected function compileHiddenField() {
      $ts_html = '';
      $ts_html .= '<div class="hide">';
      $ts_html .= '<input id="' . $this->field_id . '" name="' . $this->field_id . '" class="' . $this->field_class . '" type="hidden" value="' . $this->field_value . '" />';
      $ts_html .= '</div>';
      return $ts_html;
    }
}
?>