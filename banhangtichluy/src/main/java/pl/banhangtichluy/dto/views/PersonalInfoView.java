package pl.banhangtichluy.dto.views;

import io.swagger.annotations.ApiModel;
import io.swagger.annotations.ApiModelProperty;
import lombok.Data;
import lombok.EqualsAndHashCode;
import lombok.NoArgsConstructor;
import lombok.experimental.SuperBuilder;

import java.util.List;

@Data
@SuperBuilder
@NoArgsConstructor
@EqualsAndHashCode(callSuper = true)
@ApiModel(value = "PersonalInfoView", description = "Personal information of user")
public class PersonalInfoView extends UserBaseView {

    @ApiModelProperty(name = "authorities", notes = "List authorities name of user", example = "['ROLE_ADMIN','AMOUNT.READ','AMOUNT.CREATE']")
    private List<String> authorities;

}
