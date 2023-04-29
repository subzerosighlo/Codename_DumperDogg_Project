<?php
include 'main.php';
// Configuration file
$file = '../config.php';
// Open the configuration file for reading
$contents = file_get_contents($file);
// Format key function
function format_key($key) {
    $key = str_replace(['_', 'url', 'db ', ' pass', ' user'], [' ', 'URL', 'Database ', ' Password', ' Username'], strtolower($key));
    return ucwords($key);
}
// Format HTML output function
function format_var_html($key, $value) {
    $html = '';
    $type = 'text';
    $value = htmlspecialchars(trim($value, '\''), ENT_QUOTES);
    $type = strpos($key, 'pass') !== false ? 'password' : $type;
    $type = in_array(strtolower($value), ['true', 'false']) ? 'checkbox' : $type;
    $checked = strtolower($value) == 'true' ? ' checked' : '';
    $html .= '<label for="' . $key . '">' . format_key($key) . '</label>';
    if ($type == 'checkbox') {
        $html .= '<input type="hidden" name="' . $key . '" value="false">';
    }
    $html .= '<input type="' . $type . '" name="' . $key . '" id="' . $key . '" value="' . $value . '" placeholder="' . format_key($key) . '"' . $checked . '>';
    return $html;
}
// Format tabs
function format_tabs($contents) {
    $rows = explode("\n", $contents);
    echo '<div class="tabs">';
    echo '<a href="#" class="active">General</a>';
    for ($i = 0; $i < count($rows); $i++) {
        preg_match('/\/\*(.*?)\*\//', $rows[$i], $match);
        if ($match) {
            echo '<a href="#">' . $match[1] . '</a>';
        }
    }
    echo '</div>';
}
// Format form
function format_form($contents) {
    $rows = explode("\n", $contents);
    echo '<div class="tab-content active">';
    for ($i = 0; $i < count($rows); $i++) {
        preg_match('/\/\*(.*?)\*\//', $rows[$i], $match);
        if ($match) {
            echo '</div><div class="tab-content">';
        }
        preg_match('/define\(\'(.*?)\', ?(.*?)\)/', $rows[$i], $match);
        if ($match) {
            echo format_var_html($match[1], $match[2]);
        }
    }  
    echo '</div>';
}
if (!empty($_POST)) {
    // Update the configuration file with the new keys and values
    foreach ($_POST as $k => $v) {
        $v = in_array(strtolower($v), ['true', 'false']) ? strtolower($v) : '\'' . $v . '\'';
        $contents = preg_replace('/define\(\'' . $k . '\'\, ?(.*?)\)/s', 'define(\'' . $k . '\',' . $v . ')', $contents);
    }
    file_put_contents('../config.php', $contents);
    header('Location: settings.php?success_msg=1');
    exit;
}
// Handle success messages
if (isset($_GET['success_msg'])) {
    if ($_GET['success_msg'] == 1) {
        $success_msg = 'Settings updated successfully!';
    }
}
?>
<?=template_admin_header('Settings', 'settings')?>

<h2>Settings</h2>

<?php if (isset($success_msg)): ?>
<div class="msg success">
    <i class="fas fa-check-circle"></i>
    <p><?=$success_msg?></p>
    <i class="fas fa-times"></i>
</div>
<?php endif; ?>

<?=format_tabs($contents)?>
<div class="content-block">
    <form action="" method="post" class="form responsive-width-100">
        <?=format_form($contents)?>
        <div class="submit-btns">
            <input type="submit" value="Save">
        </div>
    </form>
</div>

<script>
document.querySelectorAll("input[type='checkbox']").forEach(checkbox => {
    checkbox.onclick = () => {
        checkbox.value = checkbox.checked ? 'true' : 'false';
    };
});
</script>

<?=template_admin_footer()?>