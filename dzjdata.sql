-- 大藏经问题字符数据
CREATE TABLE IF NOT EXISTS tptk_error_char (
  id BIGSERIAL PRIMARY KEY,
  page_code varchar(16) DEFAULT NULL, -- 'page：YB_1_1'
  image_path varchar(64) DEFAULT NULL, -- '图片路径'
  line_num int DEFAULT NULL, -- '行号'
  error_char varchar(32) DEFAULT NULL, -- '问题字符'
  line_txt varchar(128) DEFAULT NULL, -- '问题所在的行文本'
  check_txt varchar(128) DEFAULT NULL, -- '初校结果'
  confirm_txt varchar(128) DEFAULT NULL, -- '审定结果'
  status smallint DEFAULT NULL, -- '状态：未开始，校对中，已校对，审定中，已审定'
  remark varchar(128) DEFAULT NULL -- '备注'
);

-- 大藏经字符数据校对、审定任务
CREATE TABLE IF NOT EXISTS tptk_error_char_task (
  id BIGSERIAL PRIMARY KEY,
  tptk_error_char_id BIGSERIAL NOT NULL, -- 'page'
  user_id INT DEFAULT NULL, -- '用户名'
  task_type smallint DEFAULT NULL, -- '任务类型：初校、审定'
  status smallint DEFAULT NULL, -- '任务状态：未分配，已分配，已完成'
  created_at INT NOT NULL,
  assigned_at  INT DEFAULT NULL,
  completed_at INT DEFAULT NULL
);

-- 大藏经千字文补录数据
CREATE TABLE IF NOT EXISTS tptk_add_thou_char (
  id BIGSERIAL PRIMARY KEY,
  page_code varchar(16) DEFAULT NULL, -- 'page：YB_1_1'
  image_path varchar(64) DEFAULT NULL, -- '图片路径'
  block_num int DEFAULT NULL, -- '栏号'
  line_num int DEFAULT NULL, -- '行号'
  add_txt varchar(128) DEFAULT NULL, -- '问题所在的行文本'
  remark varchar(128) DEFAULT NULL -- '备注'
);

-- 大藏经千字文补录任务
CREATE TABLE IF NOT EXISTS tptk_add_thou_char_task (
  id BIGSERIAL PRIMARY KEY,
  tptk_page_id BIGSERIAL NOT NULL, -- 'page'
  user_id INT DEFAULT NULL, -- '用户名'
  status smallint DEFAULT NULL, -- '任务状态：未分配，已分配，已完成'
  created_at INT NOT NULL,
  assigned_at  INT DEFAULT NULL,
  completed_at INT DEFAULT NULL
);

-- 大藏经页标注数据
CREATE TABLE IF NOT EXISTS tptk_page (
  id BIGSERIAL PRIMARY KEY,
  page_source varchar(16) DEFAULT NULL, -- '图片来源：YB/QL/JX/1000GL/1000MulTptk/60HuaYan/1000LinePosition/500MulTptk'
  page_code varchar(16) DEFAULT NULL, -- 'page：YB_1_1'
  image_path varchar(64) DEFAULT NULL, -- '图片路径'
  txt text DEFAULT NULL, -- '文本'
  if_match smallint DEFAULT NULL, -- '图文是否匹配'
  page_type smallint DEFAULT NULL, -- '图片类型：含特殊字符、含夹注小字、不含文本、标准图片、图文不匹配'
  frame_cut text DEFAULT NULL, -- '文字框切分信息'
  line_cut text DEFAULT NULL, -- '行切分信息'
  char_cut text DEFAULT NULL, -- '字切分信息'
  remark varchar(128) DEFAULT NULL -- '备注'
);