-- 大藏经问题字符数据
CREATE TABLE IF NOT EXISTS tptk_error_char (
  id BIGSERIAL PRIMARY KEY,
  page varchar(16) DEFAULT NULL, -- 'page：YB_1_1'
  image_path varchar(64) DEFAULT NULL, -- '图片路径'
  line int DEFAULT NULL, -- '行号'
  line_txt varchar(128) DEFAULT NULL, -- '问题所在的行文本'
  error_char varchar(16) DEFAULT NULL, -- '问题字符'
  check_char varchar(16) DEFAULT NULL, -- '初校结果'
  confirm_char varchar(16) DEFAULT NULL, -- '审定结果'
  status smallint DEFAULT NULL, -- '状态：未开始，校对中，已校对，审定中，已审定'
  remark varchar(128) DEFAULT NULL -- '备注'
);

-- 大藏经字符数据校对、审定任务
CREATE TABLE IF NOT EXISTS tptk_error_char_task (
  id BIGSERIAL PRIMARY KEY,
  tripitaka_error_char_id BIGSERIAL NOT NULL, -- 'page'
  user_id INT DEFAULT NULL, -- '用户名'
  task_type smallint DEFAULT NULL, -- '任务类型：初校、审定'
  status smallint DEFAULT NULL, -- '任务状态：未分配，已分配，已完成'
  created_at INT NOT NULL,
  updated_at INT NOT NULL 
);

-- 大藏经页数据
CREATE TABLE IF NOT EXISTS tptk_page (
  id BIGSERIAL PRIMARY KEY,
  page varchar(16) DEFAULT NULL, -- 'page：YB_1_1'
  image_path varchar(64) DEFAULT NULL, -- '图片路径'
  origin_txt varchar(128) DEFAULT NULL, -- '初始文本'
  txt varchar(16) DEFAULT NULL, -- '文本'
  page_type smallint DEFAULT NULL, -- '图片类型：含特殊字符、含夹注小字、不含文本、标准图片'
  frame_cut text DEFAULT NULL, -- '文字框切分信息'
  line_cut text DEFAULT NULL, -- '行切分信息'
  char_cut text DEFAULT NULL, -- '字切分信息'
  status smallint DEFAULT NULL, -- '状态：未开始，校对中，已校对，审定中，已审定'
  remark varchar(128) DEFAULT NULL -- '备注'
);

-- 大藏经字符数据校对、审定任务
CREATE TABLE IF NOT EXISTS tptk_page_task (
  id BIGSERIAL PRIMARY KEY,
  tripitaka_page_id BIGSERIAL NOT NULL, -- 'page'
  user_id INT DEFAULT NULL, -- '用户名'
  task_type smallint DEFAULT NULL, -- '任务类型：初校、审定'
  txt varchar(16) DEFAULT NULL, -- '审定结果'
  page_type smallint DEFAULT NULL, -- '图片类型：含特殊字符、含夹注小字、不含文本、标准图片'
  status smallint DEFAULT NULL, -- '任务状态：未分配，已分配，已完成'
  created_at INT NOT NULL,
  updated_at INT NOT NULL 
);