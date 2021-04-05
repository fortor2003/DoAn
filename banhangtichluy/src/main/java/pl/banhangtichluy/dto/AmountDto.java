package pl.banhangtichluy.dto;

import com.fasterxml.jackson.annotation.JsonProperty;
import pl.banhangtichluy.annotaions.ValidateEnum;
import pl.banhangtichluy.enums.AmountType;

import javax.validation.constraints.*;

public class AmountDto {

    @JsonProperty("id")
    private String id;

    @NotNull(message = "type is required")
    @ValidateEnum(targetClassType = AmountType.class, message = "Value must in [\"POINT\", \"GIFT\"]")
    @JsonProperty("type")
    private String type;

    @NotBlank(message = "code is required")
    @JsonProperty("code")
    private String code;

    @NotNull(message = "value is required")
    @Min(value = 0, message = "value be greater or equal 0")
    @JsonProperty("value")
    private Integer value;

    @NotBlank(message = "firstName is required")
    @JsonProperty("firstName")
    private String firstName;

    @NotBlank(message = "lastName is required")
    @JsonProperty("lastName")
    private String lastName;

    @Email(message = "email should be valid")
    @JsonProperty("email")
    private String email;

    @JsonProperty("phone")
    private String phone;

    @JsonProperty("note")
    private String note;

}
