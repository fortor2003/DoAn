package pl.banhangtichluy.validators;

import pl.banhangtichluy.validators.annotaions.ValidEnum;

import javax.validation.ConstraintValidator;
import javax.validation.ConstraintValidatorContext;
import java.util.EnumSet;
import java.util.Set;
import java.util.stream.Collectors;

public class EnumValidator implements ConstraintValidator<ValidEnum, String> {
    private Set<String> allowedValues;

    @SuppressWarnings({ "unchecked", "rawtypes" })
    @Override
    public void initialize(ValidEnum targetEnum) {
        Class<? extends Enum> enumSelected = targetEnum.targetClassType();
        allowedValues = (Set<String>) EnumSet.allOf(enumSelected).stream().map(e -> ((Enum<? extends Enum<?>>) e).name())
                .collect(Collectors.toSet());
    }

    @Override
    public boolean isValid(String value, ConstraintValidatorContext context) {
        return value == null || allowedValues.contains(value)? true : false;
    }
}