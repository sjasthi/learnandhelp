USE learn_and_help_db;

-- OPENAI_API_KEY is longer than 50 characters, so need to enlarge Value's size to fit.
ALTER TABLE `preferences` MODIFY `Value` varchar(100);

-- Cannot add OpenAI api key to Github without the key being disabled by OpenAI. Will need to add manually.
INSERT INTO `preferences` (`Preference_Name`, `Value`) VALUES
('OPENAI_API_KEY', ''),
('KEYWORDS', 'schools, books, libraries, reading');
