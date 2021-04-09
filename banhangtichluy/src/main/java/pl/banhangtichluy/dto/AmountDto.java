package pl.banhangtichluy.dto;

import com.fasterxml.jackson.annotation.JsonProperty;
import com.fasterxml.jackson.databind.annotation.JsonDeserialize;
import lombok.Data;
import lombok.Getter;
import pl.banhangtichluy.deserializers.WhiteSpaceRemovalDeserializer;
import pl.banhangtichluy.enums.AmountType;
import pl.banhangtichluy.validators.annotaions.ValidEnum;

import javax.validation.constraints.Email;
import javax.validation.constraints.Min;
import javax.validation.constraints.NotBlank;
import javax.validation.constraints.NotNull;

@Data
public class AmountDto {

    @NotNull(message = "type is required")
    @ValidEnum(targetClassType = AmountType.class, message = "Value must in [\"POINT\", \"GIFT\"]")
    @JsonProperty("type")
    @JsonDeserialize(using = WhiteSpaceRemovalDeserializer.class)
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
    @JsonDeserialize(using = WhiteSpaceRemovalDeserializer.class)
    private String note;

}
