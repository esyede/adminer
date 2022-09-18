<?php

class AdminerCollations
{
    private $charsets;

    public function __construct(array $charsets = ['utf8mb4_general_ci', 'ascii_general_ci'])
    {
        $this->charsets = $charsets;
    }

    public function head()
    {
        if (empty($this->charsets)) {
            return;
        }

        echo '<script '.nonce().'>(function(document) { "use strict"; const charsets = [';
        echo "'(".lang('collation').")'";
        foreach ($this->charsets as $characterSet) {
            echo ", '".$characterSet."'";
        }
        echo '];
                document.addEventListener("DOMContentLoaded", init, false);
                function init() {
                    var selects = document.querySelectorAll(\'select[name="Collation"], select[name*="collation"]\');
                    for (var i = 0; i < selects.length; i++) {
                        replaceOptions(selects[i]);
                    }
                }
                function replaceOptions(select) {
                    var selectedSet = getSelectedSet(select);
                    var html = "";
                    var hasSelected = false;
                    for (var i = 0; i < charsets.length; i++) {
                        if (charsets[i] === selectedSet) {
                            hasSelected = true;
                            html += \'<option selected="selected">\' + charsets[i] + \'</option>\';
                        } else {
                            html += "<option>" + charsets[i] + "</option>";
                        }
                    }
                    if (!hasSelected && selectedSet !== "") {
                        html += \'<option selected="selected">\' + selectedSet + \'</option>\';
                    }
                    select.innerHTML = html;
                }
                function getSelectedSet(select) {
                    var options = select.getElementsByTagName("option");
                    for (var i = 0; i < options.length; i++) {
                        if (options[i].selected) {
                            return options[i].innerHTML.trim();
                        }
                    }
                    return "";
                }
            })(document);
        </script>';
    }
}
