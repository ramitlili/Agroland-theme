(function ($) {
    $(document).ready(function($) {
        function updateRepeaterTitles() {
            $('.elementor-repeater-item').each(function() {
                var $item = $(this);
                var $select = $item.find('.elementor-control-select2 select');
                var selectedValue = $select.val();
                
                if (selectedValue) {
                    var postTitle = $select.find('option:selected').text();
                    var $titleField = $item.find('.elementor-control-title input');
                    
                    if ($titleField.length) {
                        $titleField.val(postTitle).trigger('change');
                    }
                }
            });
        }
    
        // Update titles on select change
        $(document).on('change', '.elementor-control-select2 select', function() {
            updateRepeaterTitles();
        });
    
        // Initial update on page load
        updateRepeaterTitles();
    });
    
  
  })(jQuery);