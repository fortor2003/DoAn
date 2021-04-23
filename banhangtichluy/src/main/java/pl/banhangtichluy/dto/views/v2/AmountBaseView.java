package pl.banhangtichluy.dto.views.v2;

import com.querydsl.core.Tuple;
import com.querydsl.core.annotations.QueryProjection;
import com.querydsl.core.types.MappingProjection;
import io.swagger.annotations.ApiModel;
import io.swagger.annotations.ApiModelProperty;
import lombok.AllArgsConstructor;
import lombok.Data;
import lombok.NoArgsConstructor;
import lombok.experimental.SuperBuilder;
import pl.banhangtichluy.constants.EntityPropsDescriptionConstant;
import pl.banhangtichluy.entity.QAmount;

@Data
@SuperBuilder
@NoArgsConstructor
@ApiModel(value = "AmountBaseView", description = "Basic information of amount")
public class AmountBaseView {

    @ApiModelProperty(name = "id", notes = EntityPropsDescriptionConstant.AmountProps.ID, example = "100")
    private Long id;

    @ApiModelProperty(name = "type", notes = EntityPropsDescriptionConstant.AmountProps.TYPE, example = "POINT")
    private String type;

    @ApiModelProperty(name = "code", notes = EntityPropsDescriptionConstant.AmountProps.CODE, example = "ABCDEF123456")
    private String code;

    @ApiModelProperty(name = "value", notes = EntityPropsDescriptionConstant.AmountProps.VALUE, example = "50")
    private Integer value;

    private static final QAmount qAmount = QAmount.amount;

    public static final MappingProjection<AmountBaseView> PROJECTIONS = new MappingProjection<AmountBaseView>(
            AmountBaseView.class,
            qAmount.id, qAmount.type, qAmount.code, qAmount.value
    ) {
        @Override
        protected AmountBaseView map(Tuple row) {
            return AmountBaseView.builder()
                    .id(row.get(qAmount.id))
                    .type(row.get(qAmount.type))
                    .code(row.get(qAmount.code))
                    .value(row.get(qAmount.value))
                    .build();
        }
    };
}
