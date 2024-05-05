namespace montisgal_events.Business.Dtos.Group;

public class GroupDto(Guid id, string name, string? description, bool isPublic)
{
    public Guid Id { get; } = id;
    public string Name { get; } = name;
    public string? Description { get; } = description;
    public bool IsPublic { get; } = isPublic;
}