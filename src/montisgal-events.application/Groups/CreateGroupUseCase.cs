using montisgal_events.domain.Groups;

namespace montisgal_events.application.Groups;

public class CreateGroupUseCase(IGroupRepository repository)
{
    public async Task<Group?> Execute(string? name, string? description, bool? isPublic, Guid ownerId)
    {
        var group = new Group(Guid.NewGuid(), name, description, isPublic, ownerId);

        if (await repository.InsertGroup(group)) return group;

        return null;
    }
}