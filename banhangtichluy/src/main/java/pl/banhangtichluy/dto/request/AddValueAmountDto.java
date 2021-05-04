package pl.banhangtichluy.dto.request;

import com.fasterxml.jackson.annotation.JsonProperty;
import com.fasterxml.jackson.databind.annotation.JsonDeserialize;
import lombok.Data;
import pl.banhangtichluy.deserializers.WhiteSpaceRemovalDeserializer;
import pl.banhangtichluy.enums.AmountType;
import pl.banhangtichluy.validators.annotaions.ValidEnum;

import javax.validation.constraints.Email;
import javax.validation.constraints.Min;
import javax.validation.constraints.NotBlank;
import javax.validation.constraints.NotNull;

@Data
public class AddValueAmountDto {

    @NotNull(message = "value is required")
    @JsonProperty("value")
    private Integer value;

    @JsonProperty("note")
    @JsonDeserialize(using = WhiteSpaceRemovalDeserializer.class)
    private String note;

}
