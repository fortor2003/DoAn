package pl.banhangtichluy.constants;

import com.querydsl.core.types.dsl.PathBuilderValidator;

public class EntityPropsDescriptionConstant {

    public static class AmountProps {
        public static final String ID = "ID of amount";
        public static final String TYPE = "Type of amount (only allow 2 value 'GIFT' or 'POINT')";
        public static final String CODE = "Code of amount";
        public static final String VALUE = "Value of amount";
        public static final String FIRST_NAME = "First name of customer who owns amount";
        public static final String LAST_NAME = "Last name of customer who owns amount";
        public static final String EMAIL = "Email of customer who owns amount";
        public static final String PHONE = "Phone number of customer who owns amount";
        public static final String NOTE = "Note of amount";
        public static final String CREATED_AT = "Created time of amount";
        public static final String UPDATED_AT = "Last updated time of amount";
    }

    public static class UserProps {
        public static final String ID = "ID of user";
        public static final String USERNAME = "Username of user";
        public static final String PASSWORD = "Password of user";
        public static final String FIRST_NAME = "First name of user";
        public static final String LAST_NAME = "Last name of user";
        public static final String EMAIL = "Email of user";
        public static final String PHONE = "Phone number of user";
        public static final String NOTE = "Note of user";
        public static final String CREATED_AT = "Created time of user";
        public static final String UPDATED_AT = "Last updated time of user";
    }

}
