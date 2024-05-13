namespace montisgal_events.domain.Group.ValueObjects;

public class GroupVisibility
{
    private const bool DefaultValue = true;

    internal GroupVisibility()
    {
        Value = DefaultValue;
    }

    internal GroupVisibility(bool value)
    {
        Value = value;
    }

    public bool Value { get; }
}