<?php

/**
 * Class TUDortmund.
 * Defines the rules, actions, action params and transformer mappings
 * for "Technische Universität Dortmund".
 */
class TUDortmund extends UniversitySeeder {

    protected $universityId = 100;
    protected $published = true;

    public function run()
    {
        // create rule
        $rule = $this->createRule("Allgemein", UniversitySeeder::RULE_SEMESTER_FORMAT_SEMESTER, '(^\w+)\s*([0-9]+)');

        // create actions for rule
        $this->createAction($rule, UniversitySeeder::ACTION_TYPE_NORMAL, UniversitySeeder::HTTP_GET, '//*[@id="wrapper"]//form[@name="loginform"]/@action', $url='https://www.boss.uni-dortmund.de/qisserver/rds?state=user&type=0');
        $login = $this->createAction($rule, UniversitySeeder::ACTION_TYPE_NORMAL, UniversitySeeder::HTTP_POST, '//*[@id="makronavigation"]/ul/li[2]/a/@href');
        $this->createActionParam($login, "username", UniversitySeeder::ACTION_PARAM_TYPE_USERNAME);
        $this->createActionParam($login, "password", UniversitySeeder::ACTION_PARAM_TYPE_PASSWORD);

        $this->createAction($rule, UniversitySeeder::ACTION_TYPE_NORMAL, UniversitySeeder::HTTP_GET, '//div[@class="mikronavi_list"]//ul/li[3]/a/@href');
        $this->createAction($rule, UniversitySeeder::ACTION_TYPE_NORMAL, UniversitySeeder::HTTP_GET, '//ul[@class="treelist"]/li/a[3]/@href');

        $this->createAction($rule, UniversitySeeder::ACTION_TYPE_TABLE_GRADES, UniversitySeeder::HTTP_GET, '//*[@id="wrapper"]//div[@class="content"]/form/table[2]');

        // create transformer mappings
        $this->createTransformerMapping($rule, UniversitySeeder::TRANSFORMER_MAPPING_EXAM_ID, '//td[1]');
        $this->createTransformerMapping($rule, UniversitySeeder::TRANSFORMER_MAPPING_NAME, '//td[2]');
        $this->createTransformerMapping($rule, UniversitySeeder::TRANSFORMER_MAPPING_SEMESTER, '//td[3]');
        $this->createTransformerMapping($rule, UniversitySeeder::TRANSFORMER_MAPPING_GRADE, '//td[4]');
        $this->createTransformerMapping($rule, UniversitySeeder::TRANSFORMER_MAPPING_STATE, '//td[5]');
        $this->createTransformerMapping($rule, UniversitySeeder::TRANSFORMER_MAPPING_CREDIT_POINTS, '//td[6]');
        $this->createTransformerMapping($rule, UniversitySeeder::TRANSFORMER_MAPPING_ANNOTATION, '//td[8]');
        $this->createTransformerMapping($rule, UniversitySeeder::TRANSFORMER_MAPPING_ATTEMPT, '//td[9]');
        $this->createTransformerMapping($rule, UniversitySeeder::TRANSFORMER_MAPPING_EXAM_DATE, '//td[10]');

        $this->createTransformerMapping($rule, UniversitySeeder::TRANSFORMER_MAPPING_ITERATOR, "//tr[./td[starts-with(@class, 'tabelle1')] and count(./td) = 10]");

    }
}