package pl.banhangtichluy.dto.request;

import com.fasterxml.jackson.annotation.JsonProperty;
import com.fasterxml.jackson.databind.annotation.JsonDeserialize;
import io.swagger.annotations.ApiModel;
import io.swagger.annotations.ApiModelProperty;
import io.swagger.annotations.ApiParam;
import lombok.Data;
import lombok.Getter;
import pl.banhangtichluy.constants.EntityPropsDescriptionConstant;
import pl.banhangtichluy.deserializers.WhiteSpaceRemovalDeserializer;
import pl.banhangtichluy.enums.AmountType;
import pl.banhangtichluy.validators.annotaions.ValidEnum;

import javax.validation.constraints.Email;
import javax.validation.constraints.Min;
import javax.validation.constraints.NotBlank;
import javax.validation.constraints.NotNull;
import java.io.Serializable;

@Data
@ApiModel(value = "AmountDto", description = "Information used to create or update amount")
public class AmountDto {


    @NotNull(message = "type is required")
    @ValidEnum(targetClassType = AmountType.class, message = "Value must in [\"POINT\", \"GIFT\"]")
    @JsonProperty("type")
    @JsonDeserialize(using = WhiteSpaceRemovalDeserializer.class)
    @ApiModelProperty(name = "type", notes = EntityPropsDescriptionConstant.AmountProps.TYPE, required = true, example = "POINT")
    private String type;

    @NotBlank(message = "code is required")
    @JsonProperty("code")
    @JsonDeserialize(using = WhiteSpaceRemovalDeserializer.class)
    @ApiModelProperty(name = "code", notes = EntityPropsDescriptionConstant.AmountProps.CODE, required = true, example = "ABCDEF123456")
    private String code;

    @NotNull(message = "value is required")
    @Min(value = 0, message = "value be greater or equal 0")
    @JsonProperty("value")
    @ApiModelProperty(name = "value", notes = EntityPropsDescriptionConstant.AmountProps.VALUE, required = true, example = "50")
    private Integer value;

    @NotBlank(message = "firstName is required")
    @JsonProperty("firstName")
    @ApiModelProperty(name = "firstName", notes = EntityPropsDescriptionConstant.AmountProps.FIRST_NAME, required = true, example = "Earle")
    private String firstName;

    @NotBlank(message = "lastName is required")
    @JsonProperty("lastName")
    @ApiModelProperty(name = "lastName", notes = EntityPropsDescriptionConstant.AmountProps.LAST_NAME, required = true, example = "Schowalter")
    private String lastName;

    @Email(message = "email should be valid")
    @JsonProperty("email")
    @ApiModelProperty(name = "email", notes = EntityPropsDescriptionConstant.AmountProps.EMAIL, required = false, example = "jonaswiegand@example.com")
    private String email;

    @JsonProperty("phone")
    @ApiModelProperty(name = "phone", notes = EntityPropsDescriptionConstant.AmountProps.PHONE, required = false, example = "(236) 580-9438")
    private String phone;

    @JsonProperty("note")
    @ApiModelProperty(name = "note", notes = EntityPropsDescriptionConstant.AmountProps.NOTE, required = false, example = "this is an example of a note")
    @JsonDeserialize(using = WhiteSpaceRemovalDeserializer.class)
    private String note;

}
