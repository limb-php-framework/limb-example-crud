<?php
// Дополняем include_path директорией проекта и директорией с Limb3 пакетами (по умолчанию это my_app/lib)
set_include_path(implode(PATH_SEPARATOR,
  array(
    dirname(__FILE__),
    dirname(__FILE__) . '/lib/',
    get_include_path()
  )
));

// здесь подключается файл setup.override.php, перекрывающий настройки в этом (setup.php) файле
// это может быть использовано для различных настроек в режиме разработки и боевом режиме
// по умолчанию файл не существует, однако, его шаблон можно посмотреть в файле setup.override.php.tpl
if(file_exists(dirname(__FILE__) . '/setup.override.php'))
  require_once(dirname(__FILE__) . '/setup.override.php');

// подключим наиболее часто используемые составляющие пакетов core и web_app
require_once('limb/core/common.inc.php');
lmb_package_require('web_app');

// Служебная переменная окружения LIMB_VAR_DIR указывает на расположение временных/изменяемых файлов(различные кеши, компилированные шаблоны, временные файлы и т.д).
lmb_env_setor('LIMB_VAR_DIR', dirname(__FILE__) . '/var/');
if(!is_dir(lmb_env_get('LIMB_VAR_DIR')))
  throw new Exception('Limb var dir defined but no directory really exists at "' . lmb_env_get('LIMB_VAR_DIR'). '"');

lmb_require('src/model/*.class.php')
?>