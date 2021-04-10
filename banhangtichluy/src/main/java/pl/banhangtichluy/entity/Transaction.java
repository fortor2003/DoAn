package pl.banhangtichluy.entity;

import com.fasterxml.jackson.annotation.JsonIgnoreProperties;
import com.fasterxml.jackson.annotation.JsonProperty;
import lombok.*;

import javax.persistence.*;

@Entity
@Table(name = "transactions")
@Getter
@Setter
@NoArgsConstructor
@AllArgsConstructor
public class Transaction extends BaseEntity{

    @Column(name = "code")
    @JsonProperty("code")
    private String code;

    @Column(name = "before_value")
    @JsonProperty("beforeValue")
    private Integer beforeValue;

    @Column(name = "plus_value")
    @JsonProperty("plusValue")
    private Integer plusValue;

    @Column(name = "after_value")
    @JsonProperty("afterValue")
    private Integer afterValue;

    @ManyToOne(fetch = FetchType.LAZY)
    @JoinColumn(name = "amount_id")
    @EqualsAndHashCode.Exclude
    @ToString.Exclude
    @JsonIgnoreProperties(Amount_.TRANSACTIONS)
    @JsonProperty("amount")
    private Amount amount;

    @ManyToOne(fetch = FetchType.LAZY)
    @JoinColumn(name = "created_by")
    @EqualsAndHashCode.Exclude
    @ToString.Exclude
    @JsonIgnoreProperties(User_.CREATED_TRANSACTIONS)
    @JsonProperty("createdBy")
    private User createdBy;

    @ManyToOne(fetch = FetchType.LAZY)
    @JoinColumn(name = "updated_by")
    @EqualsAndHashCode.Exclude
    @ToString.Exclude
    @JsonIgnoreProperties(User_.UPDATED_TRANSACTIONS)
    @JsonProperty("updatedBy")
    private User updatedBy;

}
